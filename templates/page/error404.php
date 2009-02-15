<?php $this->with_envelope() ?>
<?php start_slot('page-navigation') ?>
	<li><a href="<?php ee($ctx->application_root(), $slug) ?>;edit">Edit</a></li>
<?php end_slot() ?>
<h2>Lost?</h2>
<p>&lsquo;Bother,&rsquo; said Pooh, as he discovered he&rsquo;d wandered into the bad part of town...</p>
<?php if (!empty($message)) { ?>
	<hr>
	<p>The error message was: <?php ee($message) ?></p>
<?php } ?>
