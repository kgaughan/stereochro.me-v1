<?php
$this->with_envelope();

start_slot('section-navigation');
if (cache('weblog:summary')) {
	$archive_summary = WeblogData::get_archive_summary();
	$this->render_each('archive-summary', $archive_summary);
	cache_end();
}
end_slot();
?>
<?php start_slot('head') ?>
	<link title="Feed" rel="alternate" href="/weblog/;feed" type="application/atom+xml">
<?php end_slot_append() ?>
<?php start_slot('page-navigation') ?>
	<li><a href="/weblog/;add">Add</a></li>
<?php end_slot_append() ?>

<h1><?php get_slot('title') ?></h1>
<?php echo $generated_content ?>
