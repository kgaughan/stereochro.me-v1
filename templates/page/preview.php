<?php start_slot('title') ?>
	Previewing &lsquo;<?php echo SmartyPants(e($title)) ?>&rsquo;
<?php end_slot() ?>
<?php include 'edit-form.php' ?>
<div id="preview"><?php echo SmartyPants(Markdown($content)) ?></div>
