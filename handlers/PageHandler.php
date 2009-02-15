<?php
class PageHandler extends AFK_HandlerBase {

	public function on_get(AFK_Context $ctx) {
		global $db;
		$page = $db->query_row('
			SELECT	title, content
			FROM	pages
			WHERE	slug = %s', $ctx->slug);
		if (empty($page)) {
			$page = array('title' => '', 'content' => '');
			if ($ctx->view() == 'view') {
				$ctx->header('HTTP/1.1 404 Page Not Found');
				$ctx->change_view('edit');
			}
		}
		$ctx->merge($page);
	}

	public function on_put_view(AFK_Context $ctx) {
		global $db;
		if ($db->query_value("SELECT COUNT(*) FROM pages WHERE slug = %s", $ctx->slug) == 0) {
			$now = time();
			$db->insert('pages', array(
				'slug' => $ctx->slug,
				'title' => $ctx->title,
				'content' => $ctx->content,
				'time_c' => $now,
				'time_m' => $now,
				'user_id_c' => 0,
				'user_id_m' => 0));
		} else {
			$db->execute("
				UPDATE	pages
				SET		title = %s, content = %s, time_m = UNIX_TIMESTAMP(NOW())
				WHERE	slug = %s
				", $ctx->title, $ctx->content, $ctx->slug);
		}
		$ctx->allow_rendering();
		$ctx->redirect();
	}
}
