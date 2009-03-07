<?php
class WeblogHandler extends AFK_HandlerBase {

	public function on_get_latest(AFK_Context $ctx) {
		global $db;
		$ctx->defaults(array('as' => 'html'));

		$ctx->archive_summary = $this->get_archive_summary();
		$ctx->entries = $db->cached_query_all(300, '
			SELECT   id, time_c, link, title, via, note
			FROM     weblog
			ORDER BY time_c DESC
			LIMIT    20');
	}

	public function on_post_latest(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');

		$n = $this->new_post(
			$ctx->link, $ctx->title, $ctx->via, $ctx->note,
			AFK_Users::current()->get_id());
		if (is_null($id)) {
			add_notification('error', "That link already appears to exist!");
		}

		$ctx->allow_rendering(false);
		$ctx->redirect();
	}

	public function on_put_entry(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		if (isset($ctx->preview)) {
			$ctx->change_view('preview');
		} else {
			$this->update_post(
				$ctx->id, $ctx->link, $ctx->title, $ctx->via, $ctx->note,
				AFK_Users::current()->get_id());
			$ctx->allow_rendering(false);
			$ctx->redirect();
		}
	}

	public function on_get_add(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		$ctx->default_to_empty('link', 'title', 'via', 'note');
	}

	public function on_get_entry(AFK_Context $ctx) {
		$ctx->merge_or_not_found($this->get_entry($ctx->id));
		$ctx->archive_summary = $this->get_archive_summary();
	}

	public function on_get_edit(AFK_Context $ctx) {
		AFK_Users::prerequisites('edit');
		$ctx->merge_or_not_found($this->get_entry($ctx->id));
	}

	public function on_get_month(AFK_Context $ctx) {
		$entries = $this->get_entries_for_month($ctx->year, $ctx->month);
		if (count($entries) == 0) {
			$ctx->not_found();
		}
		$ctx->ts = mktime(0, 0, 0, $ctx->month, 1, $ctx->year);
		$ctx->entries = $entries;
		$ctx->archive_summary = $this->get_archive_summary();
	}

	private function new_post($link, $title, $via, $note, $user_id) {
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

	private function update_post($id, $link, $title, $via, $note, $user_id) {
		global $db;

		list($link, $title, $via) = array_map('trim', array($link, $title, $via));

		return $db->execute('
			UPDATE weblog
			SET    link = %s, title = %s, via = %s, note = %s,
			       time_m = UNIX_TIMESTAMP(NOW()),
			       user_id_m = %d
			WHERE  id = %d
			', $link, $title, $via, $note, $user_id, $id);
	}

	private function get_entries_for_month($year, $month) {
		global $db;

		$start = mktime(0, 0, 0, $month, 1, $year);
		$end = mktime(0, 0, 0, $month + 1, 1, $year);

		return $db->query_all('
			SELECT id, time_c, link, title, via, note
			FROM   weblog
			WHERE  time_c BETWEEN %d AND %d
			ORDER BY time_c ASC
			', $start, $end);
	}

	private function get_entry($id) {
		global $db;

		return $db->query_row('
			SELECT id, time_c, link, title, via, note
			FROM   weblog
			WHERE  id = %d', $id);
	}

	private function get_archive_summary() {
		global $db;

		return $db->cached_query_all(600, '
			SELECT   MIN(time_c) AS ts, COUNT(*) AS n
			FROM     weblog
			GROUP BY YEAR(FROM_UNIXTIME(time_c)) DESC,
			         MONTH(FROM_UNIXTIME(time_c)) DESC');
	}
}
