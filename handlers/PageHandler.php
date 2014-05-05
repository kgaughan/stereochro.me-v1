<?php
class PageHandler extends AFK_HandlerBase {

	public function on_get(AFK_Context $ctx) {
		if ($ctx->view() == 'edit') {
			Users::prerequisites('edit');
		}

		$page = PageData::get_page($ctx->slug);
		if (empty($page)) {
			$page = array('title' => '', 'content' => '', 'style' => '');
			if ($ctx->view() == 'edit' && Users::current()->is_logged_in()) {
				$ctx->header('HTTP/1.1 404 Page Not Found');
				$ctx->change_view('edit');
			} else {
				$ctx->not_found();
			}
		} elseif ($ctx->try_not_modified(md5($page['content']))) {
			return;
		}
		if ($ctx->view() == 'source') {
			$ctx->allow_rendering(false);
			$ctx->header('Content-Type: text/plain; charset=UTF-8');
			$ctx->header('X-Robots-Tag: noindex');
			$ctx->header('Connection: close');
			echo $page['content'];
		} else {
			$ctx->merge($page);
		}
	}

	public function on_put_view(AFK_Context $ctx) {
		Users::prerequisites('edit');
		if (isset($ctx->preview)) {
			$ctx->change_view('preview');
		} else {
			PageData::save($ctx->slug, $ctx->title, $ctx->content, $ctx->style, Users::current()->get_id());
			cache_remove('page:' . $ctx->REQUEST_URI);
			$ctx->allow_rendering(false);
			$ctx->redirect();
		}
	}

	public function on_get_sitemap(AFK_Context $ctx) {
		$ctx->sitemap = PageData::get_sitemap();
	}
}
