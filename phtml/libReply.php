<?php
$person = $_COOKIE['openid'];
$libQid = $_POST['qid'];
$content = $_POST['reply'];
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
if ($libQid) {
	require_once '../class/libReply.php';
	require_once '../member/my_msg.php';
	$reObj = new libReply();

	$person = $_COOKIE['openid'];
	$libQid = $_POST['qid'];
	$content = $_POST['reply'];
	$ty = $_POST['ty'];
	if ($content) {
		$reObj->setLibQid($libQid);
		$reObj->setPerson($person);
		$reObj->setContent($content);
		$bool = $reObj->insertInfo();
	}else 
	{
		echo "<div data-role='content'>
					<p>问题内容不能为空,问题提交失败!</p>
				</div>
				<br>
				<a href = '#' data-role='button' data-rel='back'>返回</a>				
				";
	}
	if ($bool) {
		if ($ty == 0) {
			my_redir("myQuestion.php");	
		}else my_redir("allQuestion.php");
		
	}
}
?>

</body>
</html>
