<?php
class Users extends AFK_HttpAuthUsers {

	protected function authenticate($username) {
		$db = DAO::get_connection();
		return $db->query_tuple("SELECT id, pwd FROM users WHERE uname = %s", $username);
	}

	protected function load(array $ids) {
		$db = DAO::get_connection();
		$db->query("SELECT id, uname FROM users WHERE id IN (%d)", $ids);
		while ($r = $db->fetch()) {
			$user = new AFK_User($r['id'], $r['uname']);
			$user->add_capabilities(array('edit'));
			$this->add($user);
		}
	}
}
