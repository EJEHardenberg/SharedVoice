<?php
/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

/* If the oauth_token is old redirect to the connect page. */
if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
$account = $connection->get('account/verify_credentials');

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;
require_once(dirname(__FILE__) . '/../database.php');

$res = mysql_query('SELECT id FROM users WHERE twitter_id =' . $account->id, $dblink);

function wrap($str){
	return '"' . mysql_real_escape_string($str) . '"';
}

$id = null;
if(!mysql_num_rows($res)){
	if( FALSE === mysql_query(
		'INSERT INTO users (twitter_name,twitter_id,oauth_token,oauth_secret) VALUES ('. implode(',',
			array( 
				wrap($account->screen_name), 
				$account->id, 
				wrap($access_token['oauth_token']), 
				wrap($access_token['oauth_token_secret']))
			)
		.')'
		,$dblink)/* end mysql_query */
	){
		error_log("Could not create twitter record in database");
		die('Problem saving your twitter information for processing');
	}
	$id = mysql_insert_id();
}else{
	$row = mysql_fetch_object($res);
	$id = $row->id;
}
mysql_close($dblink);

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
  /* The user has been verified and the access tokens can be saved for future use */
  header('Location: /thanks.html');
} else {
  /* Save HTTP status for error dialog on connnect page.*/
  header('Location: ./clearsessions.php');
}
