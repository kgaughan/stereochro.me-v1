<?php $this->with_envelope() ?>
<?php start_slot('title') ?>
	<?php if (trim($title) == '') { ?>
		New page
	<?php } else { ?>
		Editing &lsquo;<?php ee($title) ?>&rsquo;
	<?php } ?>
<?php end_slot() ?>
<form method="post" action="<?php ee($ctx->application_root(), $slug) ?>">
<h1><input type="text" name="title" id="title" value="<?php ee($title) ?>"></h1>
<p><textarea name="content" rows="25"><?php ee($content) ?></textarea></p>
<div><input type="hidden" name="_method" value="put"><input type="submit" value="Post"></div>
</form>
