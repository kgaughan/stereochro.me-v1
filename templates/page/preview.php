<?php start_slot('title') ?>
	Previewing &lsquo;<?php ee($title) ?>&rsquo;
<?php end_slot() ?>
<?php include 'edit-form.php' ?>
<div id="preview"><?php echo Markdown($content) ?></div>
