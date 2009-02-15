<div class="entry">
	<div class="meta">
		<a href="/weblog/<?php echo $id ?>">&para;</a>
		&middot;
	</div>

	<?php if ($note == '') { ?>
		<p><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></p>
	<?php } else { ?>
		<h1><a href="<?php ee($link) ?>"><?php echo format_line($title) ?></a></h1>
		<?php echo format($note) ?>
	<?php } ?>
</div>
