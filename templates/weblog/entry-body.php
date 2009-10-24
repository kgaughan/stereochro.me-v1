<div class="entry">
	<div class="meta">
		<?php if (isset($id)) { ?>
			<div><a title="Permalink" href="/weblog/<?php echo $id ?>">&infin;</a></div>
		<?php } ?>
		<?php if (!empty($via)) { ?>
			<div><a title="Via" href="<?php ee($via) ?>">&#9667;</a></div>
		<?php } ?>
	</div>

	<?php if ($title != '' && $link != '') { ?>
		<h2><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></h2>
	<?php } elseif ($title != '') { ?>
		<h2><?php echo format_line($title) ?></h2>
	<?php } ?>

	<?php if (preg_match('~^http://(?:www\.)?youtube\.com/watch\?v=([-A-Za-z0-9_]{11,})~', $link, $matches)) { ?>
		<?php $movie_url = "http://www.youtube.com/v/{$matches[1]}&rel=1" ?>
		<div class="illustration">
		<object width="425" height="355" type="application/x-shockwave-flash" data="<?php ee($movie_url) ?>">
		<param name="movie" value="<?php ee($movie_url) ?>">
		<param name="FlashVars" value="quality=best&amp;scale=showAll">
		<param name="quality" value="best">
		<param name="scale" value="showAll">
		</object>
		</div>
	<?php } elseif (preg_match('~^http://video\.google\.com/videoplay\?docid=(-?\d+)~', $link, $matches)) { ?>
		<?php $movie_url = "http://video.google.com/googleplayer.swf?hl=en&docId=" . $matches[1] ?>
		<div class="illustration">
		<object width="400" height="326" type="application/x-shockwave-flash" data="<?php ee($movie_url) ?>">
		<param name="movie" value="<?php ee($movie_url) ?>">
		<param name="FlashVars" value="playerMode=embedded&amp;quality=best&amp;scale=showAll">
		<param name="quality" value="best">
		<param name="scale" value="showAll">
		</object>
		</div>
	<?php } elseif (preg_match('~^http://(?:www\.)?vimeo\.com/(\d+)~', $link, $matches)) { ?>
		<?php $movie_url = "http://www.vimeo.com/moogaloop.swf?clip_id=" . $matches[1] ?>
		<div class="illustration">
		<object width="500" height="300" type="application/x-shockwave-flash" data="<?php ee($movie_url) ?>">
		<param name="movie" value="<?php ee($movie_url) ?>">
		<param name="FlashVars" value="quality=best&amp;scale=showAll">
		<param name="quality" value="best">
		<param name="scale" value="showAll">
		</object>
		</div>
	<?php } elseif (preg_match('~^http://(?:www\.)?dailymotion\.com/video/([a-z0-9]+)~', $link, $matches)) { ?>
		<?php $movie_url = "http://www.dailymotion.com/swf/" . $matches[1] ?>
		<div class="illustration">
		<object width="420" height="339" type="application/x-shockwave-flash" data="<?php ee($movie_url) ?>">
		<param name="movie" value="<?php ee($movie_url) ?>">
		<param name="FlashVars" value="quality=best&amp;scale=showAll">
		<param name="quality" value="best">
		<param name="scale" value="showAll">
		</object>
		</div>
	<?php } ?>

	<?php if ($note != '') { ?>
		<?php echo format($note) ?>
	<?php } ?>
</div>
