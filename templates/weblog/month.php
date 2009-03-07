<?php
$this->with_envelope('weblog');
$this->render_each('entry-body', $entries, 'no-entries');
?>
<?php start_slot('title') ?>
	Inklings in <?php ee(date('F Y', $ts)) ?>
<?php end_slot() ?>
