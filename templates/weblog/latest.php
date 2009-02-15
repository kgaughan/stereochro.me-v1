<?php $this->with_envelope() ?>
<?php start_slot('title') ?>Latest links<?php end_slot() ?>
<?php $this->render_each('entry-body', $entries, 'no-entries') ?>
