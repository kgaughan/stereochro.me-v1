<?php
class Users extends AFK_Users {

	private $realm;
	private $id;

	public function __construct($realm) {
		$this->realm = $realm;
		$this->id = null;
	}

	protected function get_current_user_id() {
		global $db;

		$ctx = AFK_Registry::context();
		if (is_null($this->id) && $ctx->__isset('PHP_AUTH_USER')) {
			$this->id = $db->query_value("
				SELECT	id
				FROM	users
				WHERE	uname = %1\$s AND
						pwd = MD5(CONCAT(%1\$s, ':', %3\$s, ':', %2\$s))
				", $ctx->PHP_AUTH_USER, $ctx->PHP_AUTH_PW, $this->realm);
		}

		if (is_null($this->id)) {
			return 0;
		}

		return $this->id;
	}

	protected function load(array $ids) {
		global $db;
		if (!$this->has(0)) {
			$anon = new AFK_User(0, 'An Anonymous Hero');
			$this->add($anon);
		}
		$db->query("SELECT id, uname FROM users WHERE id IN (%d)", $ids);
		while ($r = $db->fetch()) {
			$user = new AFK_User($r['id'], $r['uname']);
			$user->add_capabilities(array('edit'));
			$this->add($user);
		}
	}

	protected function require_auth() {
		static $called = false;
		if (!$called) {
			$called = true;
			throw new AFK_HttpException(
				'You are not authorised for access.', 401,
				array('WWW-Authenticate' => "Basic realm=\"{$this->realm}\""));
		}
	}
}
