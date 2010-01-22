<?php
$this->with_envelope('weblog');
set_slot('page_classes', 'entry-page');
$this->render('edit-links', array(
	'url' => $ctx->application_root() . "weblog/$id;edit"));

if (cache('weblog:' . $id)) {
	include 'entry-body.php';
	include 'entry-footer.php';
	cache_end();
}
?>
