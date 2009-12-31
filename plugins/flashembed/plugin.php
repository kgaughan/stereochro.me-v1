<?php
class FlashEmbedPlugin extends Plugin {
	
	protected function get_events() {
		return array(
			'render_link',
			'tag:flash' => 'render_flash_tag',
			'tag:movie' => 'render_movie_tag');
	}

	public function render_link($msg, $url) {
		$embed = $this->generate_movie_embed($url);
		return array($embed === false, $embed === false ? $url : $embed);
	}

	public function render_flash_tag($msg, array $attrs) {
		if (!isset($attrs['url'])) {
			return array(false, '');
		}
		$url = $attrs['url'];
		$width = isset($attrs['width']) ? $attrs['width'] : 400;
		$height = isset($attrs['height']) ? $attrs['height'] : 400;
		unset($attrs['url'], $attrs['width'], $attrs['height']);

		return array(false, $this->generate_flash_embed($url, $width, $height, $attrs));
	}

	public function render_movie_tag($msg, array $attrs) {
		if (!isset($attrs['url'])) {
			return array(false, '');
		}
		$url = $attrs['url'];
		$width = isset($attrs['width']) ? $attrs['width'] : null;
		$height = isset($attrs['height']) ? $attrs['height'] : null;

		$embed = $this->generate_movie_embed($url, $width, $height);
		return array($embed === false, $embed === false ? $attrs : $embed);
	}

	private function generate_flash_embed($movie_url, $width, $height, array $params) {
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

	private function generate_movie_embed($link, $width=null, $height=null) {
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
				return $this->generate_flash_embed(
					sprintf($params['pattern'], $matches[1]),
					AFK::coalesce($width, $params['width']),
					AFK::coalesce($height, $params['height']),
					array());
			}
		}
		return false;
	}
}

// Instantiate an instance of this particular plugin.
new FlashEmbedPlugin();
