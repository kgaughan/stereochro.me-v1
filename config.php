<?php
if (file_exists(APP_ROOT . '/site-config.php')) {
	require APP_ROOT . '/site-config.php';
} else {
	require APP_ROOT . '/deployment/configurations/default.php';
}

define('PAGE_DATE', 'G:i \o\n F jS, Y');
define('PAGE_LIMIT', 40);

function routes() {
	$r = new AFK_Routes(array(
		'slug' => '[-a-z0-1.]+(?:/[-a-z0-1.]+)?|',
		'id' => '[1-9]\d*',
		'year' => '[1-9]\d{3}',
		'month' => '0[1-9]|1[0-2]'));

	$r->defaults(array('_handler' => 'Weblog'));
	$r->route('/weblog/', array('_view' => 'latest'));
	$r->route('/weblog/;feed', array('_view' => 'feed'));
	$r->route('/weblog/;add', array('_view' => 'add'));
	$r->route('/weblog/{id}', array('_view' => 'entry'));
	$r->route('/weblog/{id};edit', array('_view' => 'edit'));
	$r->route('/weblog/{year}-{month}', array('_view' => 'month'));

	$r->defaults(array('_handler' => 'Page'));
	$r->route('/{slug};source', array('_view' => 'source'));
	$r->route('/{slug};edit', array('_view' => 'edit'));
	$r->route('/{slug}', array('_view' => 'view'));

	return $r;
}

function init() {
	global $db;
	global $cache;

	error_reporting(E_ALL);
	date_default_timezone_set(SITE_TIMEZONE);
	AFK::load_helper('core', 'forms', 'html', 'slots', 'markdown', 'smartypants', 'cache');

	$db = new DB_MySQL(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$cache = new AFK_Cache_DB($db, 'output_cache');
	cache_install($cache);

	AFK_Users::set_implementation(new Users());
	AFK_HttpAuthUsers::set_realm(AUTH_REALM);
	AFK_HttpAuthUsers::add_method(new AFK_HttpAuth_Digest(DIGEST_OPAQUE, DIGEST_PRIVATE));

	return array();
}
