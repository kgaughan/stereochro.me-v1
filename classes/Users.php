<?php
class Users extends AFK_HttpAuthUsers {

	protected function authenticate($username) {
		return DAO::query_row("
			SELECT id, pwd FROM users WHERE uname = ?
			", array($username), PDO::FETCH_NUM);
	}

	protected function load(array $ids) {
		$iter = DAO::query("SELECT id, uname FROM users WHERE id IN (" . DAO::flatten($ids) . ")", array());
		foreach ($iter as $r) {
			$user = new AFK_User($r['id'], $r['uname']);
			$user->add_capabilities(array('edit'));
			$this->add($user);
		}
	}
}
