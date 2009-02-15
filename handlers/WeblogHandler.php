<?php
class WeblogHandler extends AFK_HandlerBase {

	public function on_get_latest(AFK_Context $ctx) {
		global $db;

		$ctx->entries = $db->query_all('
			SELECT   id, time_c, link, title, via, note
			FROM     weblog
			ORDER BY time_c DESC
			LIMIT    20');
	}

	public function new_post($link, $title, $via, $note, $user_id) {
		global $db;

		list($link, $title, $via) = array_map('trim', array($link, $title, $via));
		$now = time();

		return $db->insert('weblog', array(
			'link' => empty($link) ? null : $link,
			'title' => $title,
			'via' => $via,
			'note' => trim($note) == '' ? '' : $note,
			'time_c' => $now,
			'time_m' => $now,
			'user_id_c' => $user_id,
			'user_id_m' => $user_id));
	}

	public function on_post_latest(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');

		$this->new_post(
			$ctx->link, $ctx->title, $ctx->via, $ctx->note,
			AFK_Users::current()->get_id());

		$ctx->allow_rendering(false);
		$ctx->redirect();
	}

	public function on_get_add(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
	}
}
