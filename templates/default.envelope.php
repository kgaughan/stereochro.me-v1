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
		// CSS naked day.
		if (!is_naked_day(time())) {
			stylesheets(array('screen', 'print'));
		}
		get_slot('head');
		?>
	</head>
	<body class="<?php get_slot('page_classes') ?>">
		<div id="masthead"><?php /* a href="http://ie.movember.com/mospace/421230" id="movember"><img src="/assets/uploads/peachy-mo.png" width="31" height="23" alt="Gimme mo money for Movember!"></a */ ?><a href="/">stereochro<span>me</span></a></div>
		<div id="outer1">
			<div id="content">
				<?php if (is_naked_day(time())) { ?>
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
