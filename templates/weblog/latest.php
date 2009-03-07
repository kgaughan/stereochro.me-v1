<?php
$this->with_envelope('weblog');
$this->render_each('entry-body', $entries, 'no-entries');
?>
<?php start_slot('title') ?>
	Latest inklings
<?php end_slot() ?>
