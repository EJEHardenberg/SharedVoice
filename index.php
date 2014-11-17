<!DOCTYPE html>
<html>
	<head>
		<title>Shared Voice</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<style type="text/css">
			body{
				font-size: 18px;
			}
			p{
				padding: 10px;
				margin: 0;
			}
			.btn{
				padding: 20px;	
			}
			blockquote{
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<hr>
			<section class="row">
				<div class="col-xs-12">
					<blockquote>
						<p>
							"There may be times when we are powerless to prevent injustice, 
							but there must never be a time when we fail to protest."
						</p>
						<footer>1986 Nobel Peace Prize Winner: <cite title="Elie Wiesel">Elie Wiesel</cite></footer>
					</blockquote>
				</div>
			</section>
			<section class="row">
				<div class="col-xs-12 center-block">
					<h1>Shared Voice
						<small>
						- A protesting tool for the activist's toolkit
						</small>
					</h1>
					
				</div>
				<div class="col-xs-12 center-block">
					<p>
						Many people use social media to reach out and communicate
					their concerns to others who feel the same. 
					</p>
					<p>
						Outreach on <a href="twitter.com">Twitter</a> can be done
						by using Hashtags to provide an easy way for others to 
						become informed on your cause.
					</p>
					<p>
						Click the button below to share your voice and say:
					</p>
					<blockquote>
						<!-- See config file for setting this message as appropriate -->
						<?php require_once dirname(__FILE__) . '/config.php'; ?>
						<p>"<?php echo TWEET; ?>"</p>
						<footer>An impassioned activist: <cite title="You">You</cite></footer>
					</blockquote>
				</div>
				<div class="col-xs-12 center-block">
					<a href="/twitteroauth/redirect.php" class="btn btn-primary center-block">
						Add Your Voice
					</a>
				</div>
			</section>
			<hr>
			<!-- Feel free to remove the link below when setting up your share, crediting me is nice though -->
			<footer>
				<p>
					To set up your own share, check the <a href="https://github.com/EJEHardenberg/SharedVoice">source code</a>
				</p>
			</footer>
		</div>
	</body>
</html>