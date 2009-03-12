<div class="entry">
	<div class="meta"><a href="/weblog/<?php echo $id ?>">&infin;</a></div>

	<?php if ($title != '' && $link != '') { ?>
		<h2><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></h2>
	<?php } elseif ($title != '') { ?>
		<h2><?php echo format_line($title) ?></h2>
	<?php } ?>

	<?php if (preg_match('~^http://www.youtube.com/watch\?v=([A-Za-z0-9_]{11,})~', $link, $matches)) { ?>
		<?php $movie_url = "http://www.youtube.com/v/{$matches[1]}&rel=1" ?>
		<div class="illustration">
		<object width="425" height="355" type="application/x-shockwave-flash" data="<?php ee($movie_url) ?>">
		<param name="movie" value="<?php ee($movie_url) ?>">
		</object>
		</div>
	<?php } ?>

	<?php if ($note != '') { ?>
		<?php echo format($note) ?>
	<?php } ?>
</div>
