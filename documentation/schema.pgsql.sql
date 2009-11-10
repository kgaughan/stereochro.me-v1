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
	time_c    INTEGER      NOT NULL,
	time_m    INTEGER      NOT NULL,
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
	link      VARCHAR(255) NULL     UNIQUE,
	via       VARCHAR(255) NOT NULL,
	time_c    INTEGER      NOT NULL,
	time_m    INTEGER      NOT NULL,
	user_id_c INTEGER      NOT NULL REFERENCES users (id),
	user_id_m INTEGER      NOT NULL REFERENCES users (id),
	note      TEXT         NOT NULL
);

CREATE INDEX weblog_created ON weblog (time_c);
CREATE INDEX weblog_modified ON weblog (time_m);
