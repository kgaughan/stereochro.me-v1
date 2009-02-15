<?php
class PageHandler extends AFK_HandlerBase {

	public function on_get(AFK_Context $ctx) {
		global $db;

		if ($ctx->view() == 'edit') {
			AFK_Users::prerequisites('edit');
		}

		$page = $db->query_row('
			SELECT title, content
			FROM   pages
			WHERE  slug = %s', $ctx->slug);
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

	private function save($slug, $title, $content, $user_id) {
		global $db;
		if ($db->query_value('SELECT COUNT(*) FROM pages WHERE slug = %s', $slug) == 0) {
			$now = time();
			$db->insert('pages', array(
				'slug' => $slug,
				'title' => $title,
				'content' => $content,
				'time_c' => $now,
				'time_m' => $now,
				'user_id_c' => $user_id,
				'user_id_m' => $user_id));
		} else {
			$db->execute('
				UPDATE pages
				SET    title = %s, content = %s, time_m = UNIX_TIMESTAMP(NOW()), user_id_m = %d
				WHERE  slug = %s
				', $title, $content, $user_id, $slug);
		}
	}

	public function on_put_view(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		if (isset($ctx->preview)) {
			$ctx->change_view('preview');
		} else {
			$this->save($ctx->slug, $ctx->title, $ctx->content, AFK_Users::current()->get_id());
			$ctx->allow_rendering(false);
			$ctx->redirect();
		}
	}
}
