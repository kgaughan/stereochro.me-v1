<?php
class WeblogData extends DAO {

	public static function new_entry($link, $title, $via, $note, $user_id) {
		list($link, $title, $via) = array_map('trim', array($link, $title, $via));
		if ($link == '') {
			$link = null;
		}
		if ($via == '') {
			$via = null;
		}

		$now = time();

		try {
			return DAO::get_connection()->insert('weblog', array(
				'link' => empty($link) ? null : $link,
				'title' => $title,
				'via' => $via,
				'note' => trim($note) == '' ? '' : $note,
				'time_c' => $now,
				'time_m' => $now,
				'user_id_c' => $user_id,
				'user_id_m' => $user_id));
		} catch (DB_DuplicateException $dex) {
			return null;
		}
	}

	public static function update_entry($id, $link, $title, $via, $note, $user_id) {
		list($link, $title, $via) = array_map('trim', array($link, $title, $via));
		if ($link == '') {
			$link = null;
		}
		if ($via == '') {
			$via = null;
		}

		try {
			return DAO::get_connection()->execute('
				UPDATE weblog
				SET    link = %s, title = %s, via = %s, note = %s,
				       time_m = UNIX_TIMESTAMP(NOW()),
				       user_id_m = %d
				WHERE  id = %d
				', $link, $title, $via, $note, $user_id, $id);
		} catch (DB_DuplicateException $dex) {
			return null;
		}
	}

	public static function get_latest_feed_entries() {
		return DAO::get_connection()->query_all('
			SELECT   id, time_m, time_c, link, title, via, note
			FROM     weblog
			ORDER BY time_m DESC
			LIMIT    %d', PAGE_LIMIT);
	}

	public static function get_latest_entries() {
		return DAO::get_connection()->query_all('
			SELECT   id, time_c, time_m, link, title, via, note
			FROM     weblog
			ORDER BY time_c DESC
			LIMIT    %d', PAGE_LIMIT);
	}

	public static function get_entries_for_month($year, $month) {
		$start = mktime(0, 0, 0, $month, 1, $year);
		$end = mktime(0, 0, 0, $month + 1, 1, $year);

		return DAO::get_connection()->query_all('
			SELECT id, time_c, link, title, via, note
			FROM   weblog
			WHERE  time_c BETWEEN %d AND %d
			ORDER BY time_c ASC
			', $start, $end);
	}

	public static function get_entry($id) {
		return DAO::get_connection()->query_row('
			SELECT id, time_c, time_m, link, title, via, note
			FROM   weblog
			WHERE  id = %d
			', $id);
	}

	public static function get_archive_summary() {
		return DAO::get_connection()->query_all('
			SELECT   MAX(time_c) AS ts, COUNT(*) AS n
			FROM     weblog
			GROUP BY YEAR(FROM_UNIXTIME(time_c)) DESC,
			         MONTH(FROM_UNIXTIME(time_c)) DESC');
	}
}
