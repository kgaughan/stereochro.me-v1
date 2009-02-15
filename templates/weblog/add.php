<?php $this->with_envelope('weblog') ?>
<?php start_slot('title') ?>New post<?php end_slot() ?>

<form method="post" action="/weblog/" class="standard">
<p><label><span>Link</span>
<input type="text" name="link" value=""></label></p>
<p><label><span>Title</span>
<input type="text" name="title" value=""></label></p>
<p><label><span>Via</span>
<input type="text" name="via" value=""></label></p>
<p><label><span>Note</span>
<textarea name="note" rows="8"></textarea></label></p>
<p><input type="submit" value="Post entry"></p>
</form>
