<?php $this->with_envelope() ?>
<?php start_slot('title') ?><?php ee($title) ?><?php end_slot() ?>
<?php start_slot('page-navigation') ?><li><a href="/weblog/<?php echo $id ?>;edit">Edit</a></li><?php end_slot_append() ?>
<h1>An inkling...</h1>
<?php include 'entry-body.php' ?>
