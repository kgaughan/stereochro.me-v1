<?php $this->with_envelope('weblog') ?>
<?php start_slot('title') ?>Latest inklings<?php end_slot() ?>
<?php $this->render_each('entry-body', $entries, 'no-entries') ?>
