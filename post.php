<?php
/*
	Main workhorse. 
	
	Note to developer. The script will remove the credentials of those 
	who have authorized it. THIS IS INTENTIONAL. 

	You get a one time post for a user, no more, this is to make sure you
	do not abuse the power given to you. Also, please, please, please
	refrain from changing the TWEET text to something else after a user
	has agreed to post certain text. 

	You should set this script to fire on a one time cron job or something
	similar. Also, it will not work from calling it via the web, it must
	be called manually with the full intent on pulling the trigger on 
	whatever message you are sending

	-EJE

*/

if(isset($_SERVER['SERVER_NAME'])) die('');

require_once dirname(__FILE__) . '/twitteroauth/twitteroauth/twitteroauth.php';
require_once dirname(__FILE__) . '/twitteroauth/twitteroauth/OAuth.php';
require_once dirname(__FILE__) . '/config.php';
require_once dirname(__FILE__) . '/database.php'; //provides dblink

/* Yes we use mysql_* functions, no it's really not important to upgrade them
 * if we're not interacting with user content.
*/

$userRes = mysql_query("SELECT * FROM users",$dblink);
if($userRes === FALSE){
    echo 'userRes query failed' . '\n';
    exit;
}

echo ("Beginning User Processing " . mysql_num_rows($userRes)) . "
";
$processed = 0;
while (($userRow = mysql_fetch_object($userRes)) != FALSE) {

	$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $userRow->oauth_token, $userRow->oauth_secret);
    if (!is_object($twitter)) {
        echo('Error creating TwitterOAuth object') . "
        ";
        exit (-1);
    }       
    $twitter->host = 'https://api.twitter.com/1.1/';

    $statusUpdateResult = $twitter->post('statuses/update', array('status' => TWEET));

    if (!is_object($statusUpdateResult) || isset($statusUpdateResult->errors)) {
    	echo "Could not update status for user " . $userRes->twitter_name . "
    	";
    	continue;
    }

    $delQuery = mysql_query('DELETE FROM users WHERE id = '.$userRes->id, $dblink);
    if($delQuery === FALSE){
    	echo 'Could not delete user ' . $userRes->twitter_name . "
    	";
    	continue;
    }
    $processed++;

}
echo "Done User Processing
";
mysql_close($dblink);
?>