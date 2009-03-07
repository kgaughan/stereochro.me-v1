<?php
$this->with_envelope('weblog');
$this->render('edit-links', array(
	'url' => $ctx->application_root() . "weblog/$id;edit"));
include 'entry-body.php';
?>
<?php start_slot('title') ?>
	An inkling at <?php ee(date(PAGE_DATE, $time_c)) ?>
<?php end_slot() ?>
