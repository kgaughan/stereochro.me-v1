<?php $this->with_envelope() ?>
<?php start_slot('title') ?>
	<?php if (trim($title) == '') { ?>
		New page
	<?php } else { ?>
		Preview of &lsquo;<?php ee($title) ?>&rsquo;
	<?php } ?>
<?php end_slot() ?>

<form method="post" action="<?php ee($ctx->application_root(), $slug) ?>">
<h1><input type="text" name="title" id="title" value="<?php ee($title) ?>"></h1>
<p><textarea name="content" rows="25"><?php ee($content) ?></textarea></p>
<div>
<input type="hidden" name="_method" value="put">
<input type="submit" name="post" value="Post">
<input type="submit" name="preview" value="Preview">
</div>
</form>
<div id="preview"><?php echo Markdown($content) ?></div>
