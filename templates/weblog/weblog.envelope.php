<?php $this->with_envelope() ?>
<?php start_slot('page-navigation') ?>
	<li><a href="/weblog/;add">Add</a></li>
<?php end_slot() ?>
<h1><?php get_slot('title') ?></h1>
<?php echo $generated_content ?>