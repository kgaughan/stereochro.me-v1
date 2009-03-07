<?php
class WeblogData {

	public static function new_entry($link, $title, $via, $note, $user_id) {
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

	public static function update_entry($id, $link, $title, $via, $note, $user_id) {
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

	public static function get_latest_feed_entries() {
		global $db;

		return $db->query_all('
			SELECT   id, time_m, time_c, link, title, via, note
			FROM     weblog
			ORDER BY time_m DESC
			LIMIT    20');
	}

	public static function get_latest_entries() {
		global $db;

		return $db->query_all('
			SELECT   id, time_c, time_m, link, title, via, note
			FROM     weblog
			ORDER BY time_c DESC
			LIMIT    20');
	}

	public static function get_entries_for_month($year, $month) {
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

	public static function get_entry($id) {
		global $db;

		return $db->query_row('
			SELECT id, time_c, time_m, link, title, via, note
			FROM   weblog
			WHERE  id = %d
			', $id);
	}

	public static function get_archive_summary() {
		global $db;

		return $db->query_all('
			SELECT   MIN(time_c) AS ts, COUNT(*) AS n
			FROM     weblog
			GROUP BY YEAR(FROM_UNIXTIME(time_c)) DESC,
			         MONTH(FROM_UNIXTIME(time_c)) DESC');
	}
}
