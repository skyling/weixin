<?php
$openid = $_GET['openid'];
include_once '../connections/ocidb.php';
include_once '../class/lib_user.php';
include_once '../connections/mydb.php';
include_once '../class/lib_ociDeal.php';
$objSql = new mydb();
$objOci = new ocidb();
$objUser = new lib_user($openid, $objSql);
$stu_id = $objUser->getStu_id();	//获取学号
include_once '../class/renew.php';
$info = renew($stu_id, $objOci);
$pattern = '/(\\n)/';
$info = preg_replace($pattern, '<br>', $info);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<link rel="stylesheet" href="../jquery/jquery.mobile-1.4.2.min.css"/>
<script src="../jquery/jquery-2.0.2.js"></script>
<script src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
	<?echo $info;?>
</body>
</html>