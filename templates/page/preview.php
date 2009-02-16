<?php start_slot('title') ?>Previewing &lsquo;<?php echo format_line($title) ?>&rsquo;<?php end_slot() ?>
<?php include 'edit-form.php' ?>
<div id="preview"><?php echo format($content) ?></div>
