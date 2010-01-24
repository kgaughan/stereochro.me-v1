<?php
if (file_exists(APP_ROOT . '/site-config.php')) {
	require APP_ROOT . '/site-config.php';
} else {
	require APP_ROOT . '/deployment/configurations/default.php';
}

AFK::ensure_constants(array(
	'SITE_TIMEZONE' => 'UTC',
	'PAGE_DATE' => 'G:i \o\n F jS, Y',
	'PAGE_LIMIT' => 40,
	'WEBLOG_TITLE' => 'My Weblog',
	'WEBLOG_SUBTITLE' => '',
	'WEBLOG_AUTHOR' => '',
	'WEBLOG_COPYRIGHT' => 'Copyright (c) ' . date('Y')));

function routes() {
	$r = new AFK_Routes(array(
		'slug' => '[-a-z0-9.]+(?:/[-a-z0-9.]+)?|',
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
	error_reporting(E_ALL);
	date_default_timezone_set(SITE_TIMEZONE);
	AFK::load_helper('core', 'events', 'forms', 'html', 'slots', 'markdown', 'smartypants', 'cache');

	$plugins = array('flashembed', 'javaembed', 'urchin', 'prettify');
	AFK_Plugin::load(APP_ROOT . '/plugins', $plugins);

	cache_install(new AFK_Cache_DB(DAO::get_connection(), 'output_cache'));

	Users::set_implementation(new Users());
	Users::set_realm(AUTH_REALM);
	Users::add_method(new AFK_HttpAuth_Digest(DIGEST_OPAQUE, DIGEST_PRIVATE));

	return array();
}
