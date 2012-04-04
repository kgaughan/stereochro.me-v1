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
				<?php get_slot('section_navigation') ?>
				<ul id="nav">
					<li><a href="<?php le() ?>">Home</a></li>
					<li><a href="<?php le('about') ?>">About</a></li>
					<li><a href="<?php le('weblog/') ?>">Weblog</a></li>
					<li><a href="<?php le('projects') ?>">Projects</a></li>
					<li><a href="<?php le('colophon') ?>">Colophon</a></li>
					<?php get_slot('page_navigation') ?>
				</ul>
				<address>
					Copyright &copy; Keith Gaughan, 2001&#8210;<?php echo gmdate('Y') ?>.
					All Rights Reserved.
					You can stop reading now.
				</address>
			</div>
		</div>
		<?php get_slot('post_body') ?>
	</body>
</html>
