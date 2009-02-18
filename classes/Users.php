<?php
class Users extends AFK_HttpAuthUsers {

	protected function authenticate($username, $hash) {
		global $db;
		return $db->query_value(
			"SELECT id FROM users WHERE uname = %s AND pwd = %s",
			$username, $hash);
	}

	protected function get_anonymous_user() {
		return new AFK_User(AFK_Users::ANONYMOUS, 'An Anonymous Hero');
	}

	protected function load(array $ids) {
		global $db;
		$db->query("SELECT id, uname FROM users WHERE id IN (%d)", $ids);
		while ($r = $db->fetch()) {
			$user = new AFK_User($r['id'], $r['uname']);
			$user->add_capabilities(array('edit'));
			$this->add($user);
		}
	}
}
