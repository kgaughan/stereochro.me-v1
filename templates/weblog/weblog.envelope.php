<?php
$this->with_envelope();

start_slot('section_navigation');
if (cache('weblog:summary')) {
	$this->render_each('archive-summary', WeblogData::get_archive_summary());
	cache_end();
}
end_slot();
?>
<?php start_slot('head') ?>
	<link title="Feed" rel="alternate" href="<?php le('weblog/;feed') ?>" type="application/atom+xml">
<?php end_slot_append() ?>
<?php start_slot('page_navigation') ?>
	<li><a href="<?php le('weblog/;add') ?>">Add</a></li>
<?php end_slot_append() ?>

<?php if (has_slot('title')) { ?>
	<h1><?php get_slot('title') ?></h1>
<?php } ?>
<?php echo $generated_content ?>
