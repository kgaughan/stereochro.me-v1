<?php $this->with_envelope() ?>
<form method="post" action="<?php le($slug) ?>">
<h1><input type="text" name="title" id="title" value="<?php ee($title) ?>"></h1>
<p><textarea name="content" rows="25"><?php ee($content) ?></textarea></p>
<p><label>The page style should be... <input type="text" name="style" id="style" value="<?php ee($style) ?>"></label></p>
<div>
<input type="hidden" name="_method" value="put">
<input type="submit" name="post" value="Post">
<input type="submit" name="preview" value="Preview">
</div>
</form>
