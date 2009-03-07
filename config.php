<?php
if (file_exists(APP_ROOT . '/site-config.php')) {
	require(APP_ROOT . '/site-config.php');
} else {
	require(APP_ROOT . '/deployment/configurations/default.php');
}

define('PAGE_DATE', 'H:i \o\n F jS, Y');

function routes() {
	$r = new AFK_Routes(array(
		'slug' => '[-a-z0-1.]+(?:/[-a-z0-1.]+)?|',
		'id' => '[1-9]\d*',
		'year' => '[2-9]\d{3}',
		'month' => '0[1-9]|1[0-2]'));

	$r->defaults(array('_handler' => 'Weblog'));
	$r->route('/weblog/', array('_view' => 'latest'));
	$r->route('/weblog/;add', array('_view' => 'add'));
	$r->route('/weblog/{id}', array('_view' => 'entry'));
	$r->route('/weblog/{id};edit', array('_view' => 'edit'));
	$r->route('/weblog/{year}-{month}', array('_view' => 'month'));

	$r->defaults(array('_handler' => 'Page'));
	$r->route('/{slug}', array('_view' => 'view'));
	$r->route('/{slug};edit', array('_view' => 'edit'));

	return $r;
}

function init() {
	global $db;

	error_reporting(E_ALL);
	date_default_timezone_set('UTC');
	AFK::load_helper('core', 'forms', 'html', 'slots', 'markdown', 'smartypants');

	$db = new DB_MySQL(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$db->set_cache(new AFK_Cache_DB($db, 'query_cache'));

	AFK_Users::set_implementation(new Users());
	AFK_HttpAuth::set_realm('talideon.com');
	AFK_HttpAuth::add_method(new AFK_HttpAuth_Basic());

	return array();
}
