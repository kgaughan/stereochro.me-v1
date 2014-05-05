<?php $ctx->header('Content-Type: text/html; charset=utf-8') ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
	<head>
		<title>
			<?php if (get_slot('title')) { ?> - <?php } ?>Stereochrome
		</title>

		<meta name="MSSmartTagsPreventParsing" content="true">
		<meta name="Author" content="Keith Gaughan">
		<meta name="Copyright" content="Copyright (c) Keith Gaughan, 2001-<?php echo gmdate('Y') ?>">

		<meta name="ICBM" content="54.0333, -8.9000">
		<meta name="geo.position" content="54.0333;-8.9000">
		<meta name="geo.region" content="IE-SO">
		<meta name="geo.placename" content="Aclare">

		<?php
		favicon();
		// google_fonts('Droid Serif', 'Droid Sans');
		stylesheets(array('screen', 'print'));
		get_slot('head');
		?>

		<style type="text/css" media="handheld">
		#content, #footer, #masthead {
			width: 22em;
			font-size: 200%;
		}
		</style>
	</head>
	<body class="<?php get_slot('page_classes') ?>">
		<div id="masthead"><a href="<?php le() ?>">stereochro<span>me</span></a></div>
		<div id="outer1">
			<div id="content">
				<?php echo $generated_content ?>
			</div>
		</div>
		<div id="outer2">
			<div id="footer">
				<hr>
				<a href="http://en.wikipedia.org/wiki/Hacker_(programmer_subculture)"><img src="<?php le('assets/images/glider.png') ?>" style="float:right" width="55" height="55" alt="Hacker"></a>
				<?php get_slot('section_navigation') ?>
				<ul id="nav">
					<li><a href="<?php le() ?>">Home</a></li>
					<li><a href="<?php le('about') ?>">About</a></li>
					<li><a href="<?php le('weblog/') ?>">Weblog</a></li>
					<li><a href="<?php le('projects') ?>">Projects</a></li>
					<li><a href="<?php le('colophon') ?>">Colophon</a></li>
					<li><a href="<?php le('sitemap') ?>">Sitemap</a></li>
					<?php get_slot('page_navigation') ?>
				</ul>
				<address>
					Copyright &copy; Keith Gaughan, 2001&#8210;<?php echo gmdate('Y') ?>.
					All Rights Reserved.
					You can stop reading now.
				</address>
				<p>
<a href="//ipv6ready.ie/verify/d64e5fedaefdb41b1a0b198d4a4faa7a3cf832de">
  <img width="120" height="20"
	src="//d-badges.ipv6ready.ie/d/64/e5/fe/d64e5fedaefdb41b1a0b198d4a4faa7a3cf832de-s.png"
	alt="[IPv6 Ready]">
</a>
				</p>
			</div>
		</div>
		<?php get_slot('post_body') ?>
		<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-2914483-4']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		</script>
	</body>
</html>
