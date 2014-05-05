<?php
class PageData extends DAO {

	public static function get_page($slug) {
		return DAO::query_row('
			SELECT title, content, style, time_c, time_m
			FROM   pages
			WHERE  slug = :slug
			', compact('slug'));
	}

	public static function get_sitemap() {
		return DAO::query("
			SELECT slug, title, time_c, time_m
			FROM   pages
			WHERE  slug <> ''
			ORDER BY slug ASC
			", array());
	}

	public static function save($slug, $title, $content, $style, $user_id) {
		$params = array(
			'slug' => $slug,
			'title' => $title,
			'content' => $content,
			'style' => $style,
			'user_id' => $user_id);
		if (DAO::query_value('SELECT COUNT(*) FROM pages WHERE slug = :slug', compact('slug')) == 0) {
			$q = '
				INSERT INTO pages (
					slug, title, content, style, time_c, time_m, user_id_c, user_id_m
				) VALUES (
					:slug, :title, :content, :style, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, :user_id, :user_id
				)';
		} else {
			$q = '
				UPDATE pages
				SET    title = :title, content = :content, time_m = CURRENT_TIMESTAMP, user_id_m = :user_id, style = :style
				WHERE  slug = :slug';
		}
		DAO::execute($q, $params);
	}
}
