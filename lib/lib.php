<?php
function format($text) {
	return str_replace(
		array('<pre><code>', '<hr />'),
		array('<pre class="prettyprint"><code>', '<div class="hr"><hr></div>'),
		SmartyPants(Markdown($text)));
}

function format_line($text) {
	return SmartyPants(e($text));
}
