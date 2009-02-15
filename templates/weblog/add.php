<?php $this->with_envelope($embed ? 'embedded' : null) ?>

<form method="post" action="/weblog/" class="standard">
<p><label><span>Link</span>
<input type="text" name="link" value=""></label></p>
<p><label><span>Title</span>
<input type="text" name="title" value=""></label></p>
<p><label><span>Via</span>
<input type="text" name="via" value=""></label></p>
<p><label><span>Note</span>
<textarea name="note" rows="8"></textarea></label></p>
<p><input type="submit" value="Post link"></p>
</form>
