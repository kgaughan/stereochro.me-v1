<?php $this->with_envelope() ?>
<h1>Lost?</h1>
<p>&lsquo;Bother,&rsquo; said Pooh, as he discovered he&rsquo;d wandered into the bad part of town...</p>
<?php if (!empty($message)) { ?>
	<hr>
	<p>The error message was: <?php ee($message) ?></p>
<?php } ?>
