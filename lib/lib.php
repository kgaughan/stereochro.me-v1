<?php
function format($text) {
	return str_replace(
		array('<pre><code>', '<hr />', '<br />'),
		array('<pre class="prettyprint"><code>', '<div class="hr"><hr></div>', '<br>'),
		SmartyPants(Markdown(render_tags($text))));
}

function render_tags($text) {
	return preg_replace_callback(
		"/{{(?<tag>[a-z0-9]+)(?<attrs>(?:\s+[a-z0-9]+=\"[^\"]+\")*)}}/",
		'render_tag', $text);
}

function parse_attrs($text) {
	$attrs = array();
	$matches = array();
	preg_match_all("/\s+(?<key>[a-z0-9]+)=\"(?<value>[^\"]+)\"/", $text, $matches, PREG_SET_ORDER);
	foreach ($matches as $m) {
		$attrs[$m['key']] = $m['value'];
	}
	return $attrs;
}

function render_tag(array $matches) {
	list($unhandled, $result) = trigger_event(
		'tag:' . $matches['tag'],
		parse_attrs($matches['attrs']));
	return $unhandled ? $matches[0] : $result;
}

function format_line($text) {
	return SmartyPants(e($text));
}

function google_fonts() {
	$fonts = func_get_args();
	foreach ($fonts as $font) {
		printf('<link href="http://fonts.googleapis.com/css?family=%s" rel="stylesheet" type="text/css">',
			htmlentities(urlencode($font)));
	}
}

function is_naked_day($now) {
	$y = gmdate('Y', $now);
	// The 7th is our fallback if neither the 5th or 9th work.
	foreach (array(5, 9, 7) as $try) {
		$day_of_week = gmdate('N', gmmktime(0, 0, 0, 4, $try, $y));
		// Best if it's a Tuesday, Wednesday, or Thursday.
		if ($day_of_week >= 2 && $day_of_week <= 4) {
			$d = $try;
			break;
		}
	}
	$start = gmmktime(-12, 0, 0, 4, $d, $y);
	$end = gmmktime(36, 0, 0, 4, $d, $y);
	return $now >= $start && $now <= $end;
}

function generate_link_embed($link) {
	list($unhandled, $result) = trigger_event('render_link', $link);
	return $unhandled ? false : $result;
}

function ts($fmt, $ts) {
	return gmdate($fmt, is_int($ts) ? $ts : strtotime($ts));
}

function dbts($ts) {
	return ts('Y-m-d H:i:s', $ts);
}

function get_via_host($url) {
	$host = parse_url($url, PHP_URL_HOST);
	if (substr($host, 0, 4) == 'www.') {
		$host = substr($host, 4);
	}
	return $host;
}
