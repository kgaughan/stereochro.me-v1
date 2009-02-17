<div class="entry">
	<div class="meta">
		<a href="/weblog/<?php echo $id ?>"><?php ee(date(WEBLOG_DATE, $time_c)) ?></a>
	</div>

	<p><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></p>
	<?php if ($note != '') { ?>
		<?php echo format($note) ?>
	<?php } ?>
</div>
