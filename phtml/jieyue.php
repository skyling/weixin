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
$objDeal = new lib_ociDeal($objUser, $objOci);
$objDeal->getLendInfo();
$rt = $objDeal->_getLendinfo();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport"content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="../jquery/jquery.mobile-1.4.2.min.css" />
<script src="../jquery/jquery-2.0.2.js"></script>
<script src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
	<div data-role="page">
		<h3>尊敬的【<font color=''red><?=$rt[0]?></font>】,您当前借阅图书【<font color=''red><?=$rt[1][0]?></font>】本,【<font color=''red><?=$rt[1][1]?></font>】本超期,【<font color=''red><?=$rt[1][2]?></font>】本即将超期;</h3>
		<div data-role="content">
		  
		  <?php 
		  	for ($i=0;$i<count($rt[2][0]);$i++){
				if ($rt[2][1][$i] == 4) {
					$cq = '超期';
				}else {
					$cq = '正常';
				}
				echo "<ul data-role='listview'>";
		  		echo "<li>";
		  		echo $rt[2][0][$i]."  <font color='red'>".$cq."</font><br>应还日期:".$rt[2][2][$i];
		  		echo "</li>";
		  		echo "</ul>";
		  	}
		  ?>		  
		</div>
	<a href='http://lib.hnist.cn/weixin/phtml/xujie.php?openid=<?=$openid?>'><input type='button' value='一键续借'/></a>
	</div>
</body>
</html>