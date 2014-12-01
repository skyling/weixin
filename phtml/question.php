<?php 
require_once '../class/libQuestion.php';
require_once '../member/my_msg.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
<meta name = "viewport" content="width=device-width,initial-scale=1.0" />
<link href='../jquery/jquery.mobile-1.4.2.min.css' rel = 'stylesheet' type = 'text/css' ></link>
<script type="text/javascript" src="../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head> 
<body>
	<?php 
		$question = $_POST['question'];
		if($question <> ""){
			//插入数据库  转到  我的问题页面
			$person = $_COOKIE['openid'];
			$content = $question;
			$libQObj = new libQuestion($person);
			$libQObj->setContent($content);
			$bool = $libQObj->insetInfo();
			my_redir("myQuestion.php");
		}else{
			//输出错误
			echo "<div data-role='header'>
					<h1><a href='ptpServer.php'>馆际一对一服务</a></h1>
				  </div>";
			echo "<div data-role='content'>
					<p>问题内容不能为空,问题提交失败!</p>
				</div>
				<br>
				<a href = '#' data-role='button' data-rel='back'>返回</a>				
				";
		}
	
	?>
</body>
</html>