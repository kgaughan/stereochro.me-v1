<?php
class PageData {

	public static function get_page($slug) {
		global $db;

		return $db->query_row('
			SELECT title, content, style, time_c, time_m
			FROM   pages
			WHERE  slug = %s', $slug);
	}

	public static function save($slug, $title, $content, $style, $user_id) {
		global $db;

		if ($db->query_value('SELECT COUNT(*) FROM pages WHERE slug = %s', $slug) == 0) {
			$now = time();
			$db->insert('pages', array(
				'slug' => $slug,
				'title' => $title,
				'content' => $content,
				'style' => $style,
				'time_c' => $now,
				'time_m' => $now,
				'user_id_c' => $user_id,
				'user_id_m' => $user_id));
		} else {
			$db->execute('
				UPDATE pages
				SET    title = %s, content = %s, time_m = UNIX_TIMESTAMP(NOW()), user_id_m = %d, style = %s
				WHERE  slug = %s
				', $title, $content, $user_id, $style, $slug);
		}
	}
}
