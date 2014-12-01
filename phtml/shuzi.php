<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<link rel="stylesheet" href="../jquery/jquery.mobile-1.4.2.min.css"/>
<script src="../jquery/jquery-2.0.2.js"></script>
<script src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>
<?php 
require_once '../connections/ocidb.php';
require_once '../connections/mydb.php';
$mysql=new mydb();
$oracle=new ocidb();
$openid=$_GET['openid'];
$sql="select stu_id from lib_user where open_id='$openid' ";
$stuid=$mysql->get_one($sql);
// $sql = "select password from reader where cert_id ='$stuid'";
// $pwd=$oracle->get_one($sql);
?>
<form  name="form" action="http://lib.hnist.cn/user/login.aspx?urls=http%3a%2f%2flib.hnist.cn%2fuser%2fMyDatabase.aspx" method="post">
           <div data-role="page">
           <div data-role="header">
           <h1>数字资源</h1>
           </div> 
           <div data-role="content">   
		一卡通:<input type="text" name="username" value="<?=$stuid[0]?> " />
		密码:<input type="password" name="password"  />
		    <input type="submit" name="mylogin" value="登陆" style="background-color:#03F"/>
           </div>
           <div data-role="footer">
           </div>
   </div > 
   </form> 
</body>
</html>


