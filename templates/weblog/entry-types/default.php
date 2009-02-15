<div class="entry">
	<div class="meta">
		<a href="/weblog/<?php echo $id ?>">&para;</a>
		&middot;
	</div>

	<?php if ($note == '') { ?>
		<p><a href="<?php ee($link) ?>"><?php echo SmartyPants(e($title)) ?></a></p>
	<?php } else { ?>
		<h1><a href="<?php ee($link) ?>"><?php echo SmartyPants(e($title)) ?></a></h1>
		<?php echo SmartyPants(Markdown($note)) ?>
	<?php } ?>
</div>
