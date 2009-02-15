<?php
class WeblogHandler extends AFK_HandlerBase {

	public function on_get_latest(AFK_Context $ctx) {
		global $db;
	}

	public function on_get_add(AFK_Context $ctx) {
		$ctx->defaults(array('embed' => 0));
	}
}
