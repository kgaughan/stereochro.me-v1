<?php include 'edit-links.php' ?>
<?php $this->with_envelope() ?>
<h2>Lost?</h2>
<p>&lsquo;Bother,&rsquo; said Pooh, as he discovered he&rsquo;d wandered into the bad part of town...</p>
<?php if (!empty($message)) { ?>
	<hr>
	<p>The error message was: <?php ee($message) ?></p>
<?php } ?>
