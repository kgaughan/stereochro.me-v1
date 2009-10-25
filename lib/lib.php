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

function generate_flash_embed($movie_url, $width, $height, array $params) {
	$params_html = '<param name="movie" value="' . e($movie_url) . '">';
	if (count($params) > 0) {
		$params_html .= '<params name="FlashVars" value="' . e(http_build_query($params)) . '">';
		foreach ($params as $name => $value) {
			$params_html .= sprintf('<param name="%s" value="%s">', e($name), e($value));
		}
	}
	return sprintf(
		'<object type="application/x-shockwave-flash" data="%s" width="%s" height="%s">%s</object>',
		e($movie_url), $width, $height, $params_html);
}

function generate_link_embed($link) {
	static $patterns = array(
		'http://(?:www\.)?youtube\.com/watch\?v=([-A-Za-z0-9_]{11,})' => array(
			'pattern' => "http://www.youtube.com/v/%s&rel=1",
			'width' => 425,
			'height' => 355),
		'http://video\.google\.com/videoplay\?docid=(-?\d+)' => array(
			'pattern' => "http://video.google.com/googleplayer.swf?hl=en&docId=%s",
			'width' => 400,
			'height' => 326),
		'http://(?:www\.)?vimeo\.com/(\d+)' => array(
			'pattern' => "http://www.vimeo.com/moogaloop.swf?clip_id=%s",
			'width' => 500,
			'height' => 300),
		'http://(?:www\.)?dailymotion\.com/video/([a-z0-9]+)' => array(
			'pattern' => "http://www.dailymotion.com/swf/%s",
			'width' => 420,
			'height' => 339));

	foreach ($patterns as $pattern => $params) {
		if (preg_match("~^$pattern~", $link, $matches)) {
			return generate_flash_embed(
				sprintf($params['pattern'], $matches[1]),
				$params['width'], $params['height'], array());
		}
	}
	return false;
}
