<?php
class DAO {

	private static $db = null;

	public static function get_connection() {
		if (is_null(self::$db)) {
			self::$db = new DB_MySQL(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		}
		return self::$db;
	}
}
