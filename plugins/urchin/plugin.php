<?php
class UrchinPlugin extends Plugin {

	protected function get_events() {
		return array('slot:post_body' => 'embed_urchin');
	}

	public function embed_urchin($msg, $v) {
		$tracker = $this->get_setting('tracker');
		if (!empty($tracker)) {
			$ctx = AFK_Registry::_('ctx');

			$src = ($ctx->is_secure() ? 'https://ssl' : 'http://www') . '.google-analytics.com/ga.js';
			printf('<script src="%s" type="text/javascript"></script>', e($src));

			printf('<script type="text/javascript">try{_gat._getTracker("%s")._trackPageview();}catch(err){}</script>',
				e($tracker));
		}
		return array(true, false);
	}
}

// Instantiate an instance of this particular plugin.
new UrchinPlugin();
