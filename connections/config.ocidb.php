<?php
	$oci_config['db'] = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = 00.00.00.00)(PORT = 1521)))(CONNECT_DATA=(SID=orcl)))";
	$oci_config['username']= '';	//用户名
	$oci_config['password']= '';//密码
	$oci_config['charset']= 'UTF8';
	date_default_timezone_set('PRC');
	$db_config["pconnect"] = 0;				//开启持久连接
	$db_config["log"] = 1;					//开启日志
	$db_config["logfilepath"] = 'D://foxlib/weixin/log/';	//日志路径
?>