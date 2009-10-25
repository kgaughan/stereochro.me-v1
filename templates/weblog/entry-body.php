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

	<?php if (($embed = generate_link_embed($link)) !== false) { ?>
		<div class="illustration"><?php echo $embed ?></div>
	<?php } ?>

	<?php if ($note != '') { ?>
		<?php echo format($note) ?>
	<?php } ?>
</div>
