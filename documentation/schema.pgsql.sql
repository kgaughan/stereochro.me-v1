CREATE TABLE output_cache (
	id   CHAR(32) NOT NULL PRIMARY KEY,
	ts   INTEGER  NOT NULL,
	data TEXT     NOT NULL
);

CREATE INDEX output_cache_timestamp ON output_cache (ts);

CREATE TABLE users (
	id    SERIAL      NOT NULL PRIMARY KEY,
	uname CHAR(32)    NOT NULL UNIQUE,
	pwd   CHAR(32)    NOT NULL,
	name  VARCHAR(64) NOT NULL
);

CREATE TABLE pages (
	id        SERIAL       NOT NULL PRIMARY KEY,
	slug      VARCHAR(150) NOT NULL UNIQUE,
	time_c    TIMESTAMP    NOT NULL,
	time_m    TIMESTAMP    NOT NULL,
	user_id_c INTEGER      NOT NULL REFERENCES users (id),
	user_id_m INTEGER      NOT NULL REFERENCES users (id),
	title     VARCHAR(150) NOT NULL,
	content   TEXT         NOT NULL,
	style     VARCHAR(64)  NOT NULL
);

CREATE INDEX pages_created ON pages (time_c);

CREATE TABLE weblog (
	id        SERIAL       NOT NULL PRIMARY KEY,
	title     VARCHAR(150) NOT NULL,
	link      VARCHAR(511) NULL     UNIQUE,
	via       VARCHAR(511) NULL,
	time_c    TIMESTAMP    NOT NULL,
	time_m    TIMESTAMP    NOT NULL,
	user_id_c INTEGER      NOT NULL REFERENCES users (id),
	user_id_m INTEGER      NOT NULL REFERENCES users (id),
	note      TEXT         NOT NULL
);

CREATE INDEX weblog_created ON weblog (time_c);
CREATE INDEX weblog_modified ON weblog (time_m);

CREATE TABLE settings (
	module CHAR(24) NOT NULL,
	-- ENUM('dev', 'test', 'staging', 'live')
	status CHAR(7)  NOT NULL,
	name   CHAR(24) NOT NULL,
	value  TEXT     NOT NULL,

	PRIMARY KEY (module, status, name)
);
