Installation Instructions
========================================================================

6 easy steps to your activist solution

1. Setup Apache, MySQL and PHP (google is your friend)
2. Install the database schema: `mysql -u <user> -p < schema.sql
3. Copy the *conf.sample.json* file to conf.json, update with credentials
4. *Please* be sure to password protect or deny access to the conf file from the web!
5. Set the `TWEET` text in conf.json to the message you want to spread
6. Share

Some suggestions
------------------------------------------------------------------------

Use this tidbit for apache to protect your secret files

	<Files "post.php">
	    Order Allow,Deny
	    Deny from  all
	</Files>
	<Files "conf.json">
	    Order Allow,Deny
	    Deny from  all
	</Files>
