<?php
include_once 'class/wechatCallback.php';
include_once 'class/lib_response.php';
include_once 'connections/mydb.php';
include_once 'class/lib_user.php';
include_once 'class/funcDeal.php';
include_once 'connections/ocidb.php';
include_once 'class/lib_ociDeal.php';
//date_default_timezone_set('PRC');
define("TOKEN", "foxlib");
$objWechat = new wechatCallback();
$objdb = new mydb();
$objUser = new lib_user($objWechat->getFromUserName(), $objdb);
$objfunc = new funcDeal($objdb , $objWechat, $objUser);
?>