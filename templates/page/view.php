<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php echo format_line($title) ?><?php end_slot() ?>
<?php include 'edit-links.php' ?>
<h1><?php echo format_line($title) ?></h1>
<?php echo format($content) ?>
