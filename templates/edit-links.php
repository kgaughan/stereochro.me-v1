<?php start_slot('head') ?>
	<link rel="edit" title="Edit this page" href="<?php ee($url) ?>">
	<link rel="alternate" type="application/x-wiki" title="Edit this page" href="<?php ee($url) ?>">
<?php end_slot_append() ?>
<?php start_slot('page-navigation') ?>
	<li><a rel="noindex" href="<?php ee($url) ?>">Edit</a></li>
<?php end_slot_append() ?>
