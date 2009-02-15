<?php start_slot('title') ?>
	<?php if (trim($title) == '') { ?>
		New page
	<?php } else { ?>
		Editing &lsquo;<?php echo format_line($title) ?>&rsquo;
	<?php } ?>
<?php end_slot() ?>
<?php include 'edit-form.php' ?>
