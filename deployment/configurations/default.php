<?php
define('STATUS', 'DEV');

define('DB_DSN', 'pgsql:host=localhost dbname=shibumi');
define('DB_USER', 'pgsql');
define('DB_PASS', '');

define('AUTH_REALM', 'Townsville');
define('DIGEST_OPAQUE', 'icanhazcheezburger');
define('DIGEST_PRIVATE', 'topsekrut');

define('PAGE_DATE', 'G:i \o\n F jS, Y');
define('PAGE_LIMIT', 40);
define('FEED_URI_PREFIX', 'tag:talideon.com,2001:weblog');

define('WEBLOG_TITLE', 'Inklings');
define('WEBLOG_SUBTITLE', 'A stream of random things');
define('WEBLOG_AUTHOR', 'Keith Gaughan');
define('WEBLOG_COPYRIGHT', 'Copyright (c) Keith Gaughan, 2001-' . date('Y'));

define('SITE_TIMEZONE', 'UTC');
