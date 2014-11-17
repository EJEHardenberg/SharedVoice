<?php
/* 
========================================================================
=
=	IMPORTANT: Protect conf.json via server configuration
=
========================================================================
*/
$conf = json_decode(file_get_contents( dirname(__FILE__) . '/conf.json'));
define ('CONSUMER_KEY', $conf->apiKey);
define ('CONSUMER_SECRET', $conf->apiSecretKey);
define ('OAUTH_CALLBACK', 'http://voice.hardenberg.xyz/twitteroauth/callback.php' );
define ('DB_NAME', $conf->dbname);
define ('DB_USER',$conf->dbuser);
define ('DB_PASS',$conf->dbpass);
define ('DB_HOST',$conf->dbhost);
define ('TWEET', 'Add your voice to this cause');


$length = mb_strlen(preg_replace('~https?://([^\s]*)~', 'http://890123456789022', TWEET), 'UTF-8');
if($length > 140) die('YOUR TWEET IS TOO LONG');

?>