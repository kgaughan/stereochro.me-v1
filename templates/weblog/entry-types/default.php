<div class="entry">
	<div class="meta">
		<a href="/weblog/<?php echo $id ?>"><?php ee(date(WEBLOG_DATE, $time_c)) ?></a>
		<?php if ($via != '') { ?>
		<br>[<a href="<?php ee($via) ?>">source</a>]
		<?php } ?>
	</div>

	<?php if ($title != '') { ?>
	<h2><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></h2>
	<?php } ?>
	<?php if ($note != '') { ?>
		<?php echo format($note) ?>
	<?php } ?>
</div>
