<?php
/*
	Yes, mysql_* functions are deprecated as of 5.5, no I don't care.
	I'm not accepting user input, only API input so I'm really not worried
*/
require_once( dirname(__FILE__) . '/config.php');
$dblink = mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME, $dblink);
?>