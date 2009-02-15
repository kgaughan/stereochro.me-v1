<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php ee($title) ?><?php end_slot() ?>
<?php start_slot('page-navigation') ?>
	<li><a href="<?php ee($ctx->application_root(), $slug) ?>;edit">Edit</a></li>
<?php end_slot() ?>

<h1><?php ee($title) ?></h1>
<?php echo Markdown($content) ?>
