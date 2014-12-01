create table lib_cmd(
	serial int unsigned auto_increment primary key,
	cmd_key varchar(20) not null,
	cmd_type varchar(10) not null,
	cmd_remark varchar(100) not null
)


create table lib_content(
	serial int unsigned auto_increment primary key,
	con_cmd varchar(20) not null,
	con_content text,
	title text,
	description text,
	picurl text,
	url text
)