<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php echo format_line($title) ?><?php end_slot() ?>
<?php include 'edit-links.php' ?>
<h1><?php echo format_line($title) ?></h1>
<?php echo format($content) ?>
<div id="metadata">
Created at <?php ee(date(DATE_FORMAT, $time_c)) ?>
<?php if ($time_c != $time_m) { ?>
; last modified at <?php ee(date(DATE_FORMAT, $time_m)) ?>
<?php } ?>
</div>
