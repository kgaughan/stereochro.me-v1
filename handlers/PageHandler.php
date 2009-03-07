<?php
class PageHandler extends AFK_HandlerBase {

	public function on_get(AFK_Context $ctx) {
		if ($ctx->view() == 'edit') {
			AFK_Users::prerequisites('edit');
		}

		$page = PageData::get_page($ctx->slug);
		if (empty($page)) {
			$page = array('title' => '', 'content' => '');
			if ($ctx->view() == 'edit' && AFK_Users::current()->is_logged_in()) {
				$ctx->header('HTTP/1.1 404 Page Not Found');
				$ctx->change_view('edit');
			} else {
				$ctx->not_found();
			}
		}
		$ctx->merge($page);
	}

	public function on_put_view(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		if (isset($ctx->preview)) {
			$ctx->change_view('preview');
		} else {
			PageData::save($ctx->slug, $ctx->title, $ctx->content, AFK_Users::current()->get_id());
			$ctx->allow_rendering(false);
			$ctx->redirect();
		}
	}
}
