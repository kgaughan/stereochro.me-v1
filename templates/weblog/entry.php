<?php
$this->with_envelope('weblog');
$this->render('edit-links', array(
	'url' => $ctx->application_root() . "weblog/$id;edit"));

if (cache('weblog:' . $id)) {
	include 'entry-body.php';
	cache_end();
}
?>

<?php start_slot('title') ?>
	An inkling at <?php ee(date(PAGE_DATE, $time_c)) ?>
<?php end_slot() ?>
