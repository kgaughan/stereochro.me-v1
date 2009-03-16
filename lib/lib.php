<?php
function format($text) {
	return str_replace(
		array('<pre><code>', '<hr />', '<br />'),
		array('<pre class="prettyprint"><code>', '<div class="hr"><hr></div>', '<br>'),
		SmartyPants(Markdown($text)));
}

function format_line($text) {
	return SmartyPants(e($text));
}
