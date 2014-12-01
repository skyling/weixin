<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" >
<link rel="stylesheet" href="../jquery/jquery.mobile-1.4.2.min.css"/>
<script src="../jquery/jquery-2.0.2.js"></script>
<script src="../jquery/jquery.mobile-1.4.2.min.js"></script>
<script src="../js/weixin.js"></script>
</head>
<title>用户绑定</title>
<body> 
<?php
        require_once '../class/lib_user.php';
        require_once '../class/lib_ociDeal.php';
        require_once '../connections/ocidb.php';
        require_once '../connections/mydb.php';
		$stu_id = $_POST['number'];
		$passwd = $_POST['passwd'];
		$openid = $_POST['openid'];
		$mysqlobj=new mydb();
		$oracle =new ocidb();
		$user=new lib_user($openid, $mysqlobj);
		$ociDeal= new lib_ociDeal($user, $oracle);
		$result=$ociDeal->binding($stu_id, $passwd);
		if($result)
		{
			$url = "jieyue.php?openid={$openid}";
			echo "绑定成功!!!<br>您可返回微信聊天页面回复4获取您的借阅情况!<br><br>";
			echo "<a href='{$url}'><input type='button' value='查看当前借阅情况'/></a><br><br>";
			echo "如需取消绑定请直接回复消息  qxbd ";			
		}
		else
		{
			echo "绑定失败,请重新绑定!!!";
		}

		
		
		

?>
</body>
</html>