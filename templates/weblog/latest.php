<?php
$this->with_envelope('weblog');
if (cache('weblog:latest')) {
	$entries = WeblogData::get_latest_entries();
	$this->render_each('entry-body', $entries, 'no-entries');
	cache_end();
}
?>
<?php start_slot('title') ?>
	Latest inklings
<?php end_slot() ?>
