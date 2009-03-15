<?php $ctx->header('Content-Type: text/html; charset=utf-8') ?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
	<head>
		<title>
			<?php if (get_slot('title')) { ?> - <?php } ?>Talideon.com
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
		if (date('dm') != '0504') {
			stylesheets(array('screen' => array('screen', 'prettify'), 'print'));
		}
		get_slot('head');
		?>
	</head>
	<body>
		<div id="outer1">
			<div id="content">
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
