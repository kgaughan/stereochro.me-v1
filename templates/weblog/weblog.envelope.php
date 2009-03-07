<?php
$this->with_envelope();
$this->render_each('archive-summary', WeblogData::get_archive_summary());
?>
<?php start_slot('page-navigation') ?>
	<li><a href="/weblog/;add">Add</a></li>
<?php end_slot_append() ?>

<h1><?php get_slot('title') ?></h1>
<?php echo $generated_content ?>
