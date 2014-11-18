Installation Instructions
========================================================================

6 easy steps to your activist solution

1. Setup Apache, MySQL and PHP (google is your friend)
2. Install the database schema: `mysql -u <user> -p < schema.sql`
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

Detailed Steps (for app related)
------------------------------------------------------------------------

1. Create a Twitter App by going to [twitter dev center](https://dev.twitter.com) 
and scrolling down to "manage my apps".
2. Create an application and set the permissions to be able to read and write
3. Copy the access tokens from the application to your conf.json file
4. Share your live link to people to get them to sign up
5. run `php post.php`
6. Do it again

