<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php ee($title) ?><?php end_slot() ?>
<?php $this->render('edit-links', array('url' => $ctx->application_root() . "weblog/$id;edit")) ?>

<h1>An inkling...</h1>
<?php include 'entry-body.php' ?>
