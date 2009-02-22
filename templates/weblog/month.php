<?php $this->with_envelope('weblog') ?>
<?php start_slot('title') ?>
	Inklings in <?php ee(date('F Y', $ts)) ?>
<?php end_slot() ?>
<?php $this->render_each('entry-body', $entries, 'no-entries') ?>
<?php $this->render_each('archive-summary', $archive_summary) ?>
