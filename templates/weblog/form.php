<?php display_notifications() ?>
<form method="post" class="standard"
	action="/weblog/<?php echo isset($id) ? $id : '' ?>">
<p><label><span>Link</span>
<input type="text" name="link" value="<?php ee($link) ?>"></label></p>
<p><label><span>Title</span>
<input type="text" name="title" value="<?php ee($title) ?>"></label></p>
<p><label><span>Via</span>
<input type="text" name="via" value="<?php ee($via) ?>"></label></p>
<p><label><span>Note</span>
<textarea name="note" rows="8"><?php ee($note) ?></textarea></label></p>
<p>
<?php carry_hidden_values('time_c') ?>
<input type="hidden" name="_method" value="<?php echo isset($ctx->time_c) ? 'PUT' : 'POST' ?>">
<input type="submit" value="Post entry">
<input type="submit" name="preview" value="Preview">
</p>
</form>
