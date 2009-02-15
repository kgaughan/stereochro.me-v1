<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php ee($title) ?><?php end_slot() ?>
<h1><?php ee($title) ?></h1>
<?php echo Markdown($content) ?>
