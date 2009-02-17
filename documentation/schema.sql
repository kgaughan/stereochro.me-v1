CREATE TABLE pages (
	id        INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	slug      VARCHAR(150)     NOT NULL,
	time_c    INTEGER UNSIGNED NOT NULL,
	time_m    INTEGER UNSIGNED NOT NULL,
	user_id_c INTEGER UNSIGNED NOT NULL,
	user_id_m INTEGER UNSIGNED NOT NULL,
	title     VARCHAR(150)     NOT NULL,
	content   TEXT             NOT NULL,

	PRIMARY KEY (id),
	UNIQUE INDEX ux_slug (slug),
	INDEX ix_created (time_c)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE users (
	id    INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	uname CHAR(32)         NOT NULL,
	pwd   CHAR(32)         NOT NULL,
	name  VARCHAR(64)      NOT NULL,

	PRIMARY KEY (id),
	UNIQUE INDEX ux_uname (uname)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE weblog (
	id        INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
	title     VARCHAR(150)     NOT NULL,
	link      VARCHAR(255)     NULL,
	via       VARCHAR(255)     NOT NULL,
	time_c    INTEGER UNSIGNED NOT NULL,
	time_m    INTEGER UNSIGNED NOT NULL,
	user_id_c INTEGER UNSIGNED NOT NULL,
	user_id_m INTEGER UNSIGNED NOT NULL,
	note      TEXT             NOT NULL,

	PRIMARY KEY (id),
	UNIQUE INDEX ux_link (link),
	INDEX ix_created (time_c)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;