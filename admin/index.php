<?php
	session_start();
	if(!isset($_SESSION['username'])){
		echo "<script type='text/javascript'>window.location.href='./micropage/login.htm';</script>";
	}else{
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>湖南理工图书馆微信后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="./style/main.css">
	</head>
	<body>
		<div id="main">
			<!-- header -->
			<div id="header">
				<h1>湖理图书馆微信后台管理系统</h1>
			</div>
			<!-- context -->
			<div id="context">
				<div class="Cleft">
					<ul>
						<li><a href="./micropage/main.php" target="rightContext">首页</a></li>
						<li><a href="./micropage/lib_cmd.php" target="rightContext">命令管理</a></li>
						<li><a href="./micropage/lib_qr.php" target="rightContext">问答管理</a></li>
						<li><a href="./micropage/lib_user.php" target="rightContext">用户管理</a></li>
					</ul>
				</div>
				<div class="Cright">
					<iframe name="rightContext" width="780px" height="500px" src="./micropage/main.php" scrolling="yes" border=0 frameborder=0></iframe>
				</div>
			</div>
			<!-- footer -->
			<div id="footer">	
				&copy;&nbsp;湖南理工学院图书馆
			</div>
		</div>
	</body>
</html>
<?php }?>