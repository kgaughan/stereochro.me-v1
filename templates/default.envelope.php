<?php $ctx->header('Content-Type: text/html; charset=utf-8') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html lang="en">
	<head>
		<title>
			<?php if (get_slot('title')) { ?> - <?php } ?>Talideon.com
		</title>
		<?php favicon() ?>
		<?php stylesheets(array('screen', 'print')) ?>
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
				<ul id="nav">
					<li><a href="/">Home</a></li>
					<li><a href="/about">About</a></li>
					<li><a href="/weblog/">Weblog</a></li>
					<li><a href="/projects">Projects</a></li>
					<li><a href="/colophon">Colophon</a></li>
					<?php get_slot('page-navigation') ?>
				</ul>
				<address>
					Copyright &copy; Keith Gaughan, 2001&#8210;2009.
					All Rights Reserved.
					You can stop reading now.
				</address>
			</div>
		</div>
	</body>
</html>
