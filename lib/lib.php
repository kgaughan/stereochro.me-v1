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

function is_naked_day($d) {
	$start = date('U', mktime(-12, 0, 0, 04, $d, date('Y')));
	$end = date('U', mktime(36, 0, 0, 04, $d, date('Y')));
	$z = date('Z') * -1;
	$now = time() + $z;
	return $now >= $start && $now <= $end;
}
