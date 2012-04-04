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
