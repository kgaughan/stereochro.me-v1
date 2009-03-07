<?php
$this->with_envelope();
if (isset($archive_summary)) {
	$this->render_each('archive-summary', $archive_summary);
}
?>
<?php start_slot('page-navigation') ?>
	<li><a href="/weblog/;add">Add</a></li>
<?php end_slot_append() ?>

<h1><?php get_slot('title') ?></h1>
<?php echo $generated_content ?>
