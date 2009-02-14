<?php
if (file_exists(APP_ROOT . '/site-config.php')) {
	require(APP_ROOT . '/site-config.php');
} else {
	require(APP_ROOT . '/deployment/configurations/default.php');
}

require(APP_ROOT . '/lib/markdown.php');

define('APP_VERSION', '0.0.0');
define('WITH_LOGGING', STATUS == 'LIVE' || STATUS == 'STAGING');

function routes() {
	$r = new AFK_Routes(array(
		'slug' => '[-a-z0-1.]+(?:/[-a-z0-1.]+)?|'));

	$r->defaults(array('_handler' => 'User'));
	$r->route('/login', array('_view' => 'login'));

	$r->defaults(array('_handler' => 'Root'));
	$r->route('/{slug}', array('_view' => 'view'));
	$r->route('/{slug};edit', array('_view' => 'edit'));

	return $r;
}

function init() {
	global $db;

	error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	AFK::load_helper('core', 'html', 'slots');

	$db = new DB_MySQL(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// If you need sessions, you might need this:
	// new AFK_Session_DB($db, 'sessions');
	// session_start();

	// If you need output caching, you'll need this:
	// AFK::load_helper('cache');
	// cache_install(new AFK_Cache_DB($db, 'cache'));

	return array();
}
