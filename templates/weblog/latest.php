<?php $this->with_envelope() ?>
<?php start_slot('page-navigation') ?>
	<li><a href="/weblog/;add">Add</a></li>
<?php end_slot() ?>
<?php start_slot('title') ?>Latest links<?php end_slot() ?>
<?php $this->render_each('entry-body', $entries, 'no-entries') ?>
