#
# Table structure for table 'sys_file'
#
CREATE TABLE sys_file (

	title varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
	extension varchar(255) DEFAULT '' NOT NULL,
	caption varchar(255) DEFAULT '' NOT NULL,
	width varchar(255) DEFAULT '' NOT NULL,
	height varchar(255) DEFAULT '' NOT NULL,
	duration varchar(255) DEFAULT '' NOT NULL,
	download_name varchar(255) DEFAULT '' NOT NULL,
	frontend_user int(11) unsigned DEFAULT '0',
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'sys_file_collection'
#
CREATE TABLE sys_file_collection (

	frontend_user int(11) unsigned DEFAULT '0',
	type varchar(9) DEFAULT 'static' NOT NULL,

);
