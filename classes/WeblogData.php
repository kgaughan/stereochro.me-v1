<?php
class WeblogData extends DAO {

	public static function new_entry($link, $title, $via, $note, $user_id) {
		list($link, $title, $via) = array_map('trim', array($link, $title, $via));
		if (empty($link)) {
			$link = null;
		}
		if (empty($via)) {
			$via = null;
		}
		if (trim($note) == '') {
			$note = '';
		}

		return DAO::execute('
			INSERT INTO weblog (
				link, title, via, note, time_c, time_m, user_id_c, user_id_m
			) VALUES (
				:link, :title, :via, :note, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :user_id, :user_id
			)', compact('link', 'title', 'via', 'note', 'user_id'));
	}

	public static function update_entry($id, $link, $title, $via, $note, $user_id) {
		list($link, $title, $via) = array_map('trim', array($link, $title, $via));
		if (empty($link)) {
			$link = null;
		}
		if (empty($via)) {
			$via = null;
		}
		if (trim($note) == '') {
			$note = '';
		}

		return DAO::execute('
			UPDATE weblog
			SET    link = :link, title = :title, via = :via, note = :note,
				   time_m = CURRENT_TIMESTAMP,
				   user_id_m = :user_id
			WHERE  id = :id
			', compact('id', 'link', 'title', 'via', 'note', 'user_id'));
	}

	public static function get_most_recent_modification_date() {
		return DAO::query_value('SELECT MAX(time_m) FROM weblog', array());
	}

	public static function get_latest_feed_entries($limit) {
		return DAO::query('
			SELECT   id, time_m, time_c, link, title, via, note
			FROM     weblog
			ORDER BY time_m DESC
			LIMIT    :limit
			', compact('limit'));
	}

	public static function get_latest_entries($limit) {
		return DAO::query('
			SELECT   id, time_c, time_m, link, title, via, note
			FROM     weblog
			ORDER BY time_c DESC
			LIMIT    :limit
			', compact('limit'));
	}

	public static function get_entries_for_month($year, $month) {
		$start = dbts(mktime(0, 0, 0, $month, 1, $year));
		$end = dbts(mktime(0, 0, 0, $month + 1, 1, $year));

		return DAO::query('
			SELECT   id, time_c, link, title, via, note
			FROM     weblog
			WHERE    time_c BETWEEN :start AND :end
			ORDER BY time_c ASC
			', compact('start', 'end'));
	}

	public static function get_entry($id) {
		return DAO::query_row('
			SELECT id, time_c, time_m, link, title, via, note
			FROM   weblog
			WHERE  id = :id
			', compact('id'));
	}

	public static function get_archive_summary() {
		return DAO::query("
			SELECT   EXTRACT(YEAR FROM MAX(time_c)) AS \"year\",
			         EXTRACT(MONTH FROM MAX(time_c)) AS \"month\",
			         COUNT(*) AS n
			FROM     weblog
			GROUP BY DATE_TRUNC('month', time_c)
			ORDER BY EXTRACT(YEAR FROM MAX(time_c)) DESC,
			         EXTRACT(MONTH FROM MAX(time_c)) ASC
			", array());
	}
}
