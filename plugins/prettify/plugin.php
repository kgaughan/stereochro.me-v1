<?php
class PrettifyPlugin extends Plugin {

	public function get_events() {
		return array(
			'slot:head' => 'send_css',
			'slot:post_body' => 'send_js');
	}

	public function send_css($msg, $v) {
		stylesheets(array('screen' => 'prettify'));
		return array(true, false);
	}

	public function send_js($msg, $v) {
		javascript(array('prettify'));
		echo '<script type="text/javascript">prettyPrint();</script>';
		return array(true, false);
	}
}

// Instantiate an instance of this particular plugin.
new PrettifyPlugin();
