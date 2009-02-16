<?php start_slot('head') ?>
	<link rel="edit" title="Edit this page" href="<?php ee($ctx->application_root(), $slug) ?>;edit">
	<!-- I don't like having this. By rights the above should work. -->
	<link rel="alternate" type="application/x-wiki" title="Edit this page" href="<?php ee($ctx->application_root(), $slug) ?>;edit">
<?php end_slot_append() ?>
<?php start_slot('page-navigation') ?>
	<li><a href="<?php ee($ctx->application_root(), $slug) ?>;edit">Edit</a></li>
<?php end_slot_append() ?>
