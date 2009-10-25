<?php $ctx->header('Content-Type: text/html; charset=utf-8') ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
	<head>
		<title>
			<?php if (get_slot('title')) { ?> - <?php } ?>Stereochrome
		</title>

		<?php if ($ctx->REQUEST_URI == '/') { ?>
			<link rel="openid.server" href="http://talideon.com/id/">
			<link rel="openid.delegate" href="http://talideon.com/id/">
		<?php } ?>

		<meta name="MSSmartTagsPreventParsing" content="true">
		<meta name="Author" content="Keith Gaughan">
		<meta name="Copyright" content="Copyright (c) Keith Gaughan, 2001-<?php echo date('Y') ?>">

		<meta name="ICBM" content="54.0333, -8.9000">
		<meta name="geo.position" content="54.0333;-8.9000">
		<meta name="geo.region" content="IE-SO">
		<meta name="geo.placename" content="Aclare">

		<link rel="blogroll" type="text/x-opml" title="Blogroll" href="http://bloglines.com/export?id=Keith">
		<link rel="subscriptions" type="text/x-opml" title="Subscriptions" href="http://bloglines.com/export?id=Keith">

		<?php
		favicon();
		// CSS naked day.
		if (!is_naked_day(9)) {
			stylesheets(array('screen' => array('prettify', 'screen'), 'print'));
		}
		get_slot('head');
		?>
	</head>
	<body>
		<div id="masthead"><a href="/">stereochro<span>me</span></a></div>
		<div id="outer1">
			<div id="content">
				<?php if (is_naked_day(9)) { ?>
					<p>[To know more about why styles are disabled on this
					website visit the <a href="http://naked.dustindiaz.com"
					title="Web Standards Naked Day Host Website">Annual CSS
					Naked Day</a> website for more information.]</p>
				<?php } ?>
				<?php echo $generated_content ?>
			</div>
		</div>
		<div id="outer2">
			<div id="footer">
				<hr>
				<?php get_slot('section-navigation') ?>
				<ul id="nav">
					<li><a href="/">Home</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="/weblog/">Weblog</a></li>
					<li><a href="/projects">Projects</a></li>
					<li><a href="/colophon">Colophon</a></li>
					<?php get_slot('page-navigation') ?>
				</ul>
				<address>
					Copyright &copy; Keith Gaughan, 2001&#8210;<?php echo date('Y') ?>.
					All Rights Reserved.
					You can stop reading now.
				</address>
			</div>
		</div>

		<?php javascript(array('prettify')) ?>
		<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
		<script type="text/javascript">
		_uacct = "UA-2914483-1";
		urchinTracker();
		prettyPrint();
		</script>
	</body>
</html>
