<?php
class DAO {

	private static $db = null;

	public static function get_connection() {
		if (is_null(DAO::$db)) {
			DAO::$db = new PDO(DB_DSN, DB_USER, DB_PASS);
			AFK_PDOHelper::behave(DAO::$db);
		}
		return DAO::$db;
	}

	public static function execute($q, array $args) {
		return AFK_PDOHelper::execute(DAO::get_connection(), $q, $args);
	}

	public static function query($q, array $args, $class='AFK_PDO_RowIterator') {
		return AFK_PDOHelper::query(DAO::get_connection(), $q, $args, $class);
	}

	public static function query_value($q, array $args) {
		return AFK_PDOHelper::query_value(DAO::get_connection(), $q, $args);
	}

	public static function query_row($q, array $args, $fetch=PDO::FETCH_ASSOC) {
		return AFK_PDOHelper::query_row(DAO::get_connection(), $q, $args, $fetch);
	}

	public static function query_map($q, array $args) {
		return AFK_PDOHelper::query_map(DAO::get_connection(), $q, $args);
	}

	public static function flatten(array $a) {
		return AFK_PDOHelper::flatten(DAO::get_connection(), $a);
	}
}
