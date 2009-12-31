<?php
class JavaEmbedPlugin extends Plugin {

	protected function get_events() {
		return array('tag:java' => 'render_java_tag');
	}

	public function render_movie_tag($msg, array $attrs) {
		if (!isset($attrs['href']) || !isset($attrs['class'])) {
			return array(false, '');
		}
		$url = $attrs['href'];
		$class = $attrs['class'];
		$width = isset($attrs['width']) ? $attrs['width'] : 400;
		$height = isset($attrs['height']) ? $attrs['height'] : 400;
		unset($attrs['href'], $attrs['width'], $attrs['height']);

		$embed = $this->generate_java_embed($url, $class, $width, $height, $attrs);
		return array($embed === false, $embed === false ? $attrs : $embed);
	}

	private function generate_java_embed($url, $class, $width, $height, array $params) {
		$params_html = '';
		foreach ($params as $name => $value) {
			$params_html .= sprintf('<param name="%s" value="%s">', e($name), e($value));
		}
		return sprintf(
			'<!--[if !IE]>--><object classid="java:%1$s" archive="%2$s" ' .
			'type="application/x-java-applet" width="%3$s" height="%4$s">' .
			'<param name="archive" value="%2$s">%5$s<!--<![endif]-->' .
			'<object classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93" width="%3$s" height="%4$s">' .
			'<param name="code" value="%1$s"><param name="archive" value="%2$s">%5$s' .
			'</object><!--[if !IE]>--></object><!--<![endif]-->',
			e($class), e($url), $width, $height, $params_html);
	}
}

// Instantiate an instance of this particular plugin.
new JavaEmbedPlugin();
