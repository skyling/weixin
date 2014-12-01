<?php
/*
 * 我的问题
 * */
require_once '../connections/mydb.php';
$dbObj = new mydb();
$num = 1;
$person = $_COOKIE['openid'];
//$query = "select * from libQuestion where person='$person' order by ptime desc limit $num,10 ";
$query = "select * from libQuestion where person='$person' order by ptime desc";
$ques_arr = $dbObj->get_all($query);//得到所有问题

function onenode($question,mydb $dbObj){
	if ($question[5]!=1) {
		$info = "未审核";
	}
	echo "<div data-role='content' style='margin:3px auto;width:80%;background-color:white;border:1px solid black;'>
			<strong>$question[3]</strong><div style='text-align:right;font-size:10px;'>$info  $question[2]</div><br>";
			////////////回复
	oneAnser($question[0],$dbObj);
			////////////表单
	libform($question);

	echo "</div>";
}
function libform($question){
	echo"<div >
	<form name='form' method='post' action='libReply.php'>
		<textarea cols='30' name='reply' height='200px'></textarea>
		<input name='qid' type='hidden' value=$question[0] />
		<input name='ty' type='hidden' value='0' />
		<p align='right'>
		<input  type='submit' data-theme='b' data-inline='true' data-mini='true' value='回复' />
		</p>
	</form>
	</div>";
}
function oneAnser($libQid,mydb $dbObj){
	$query = "select * from libReply where libQid='$libQid'";
	$ans_arr = $dbObj->get_all($query);
	if ($ans_arr){
		$i = 1;
		foreach ($ans_arr as $result){
			echo "$i.$result[4]<div style='text-align:right; font-size:10px;'>$result[3]</div><br>";
			$i++;
		}
	}
}
function myheader(){
	echo "<div data-role='header'>
			<h1><a href='ptpServer.php' style='text-decoration:none;color:black;'>馆际一对一服务</a></h1>
		  </div>";
	echo "<div data-role='header'>
			<h2>我的问题</h2>
		  </div>";

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
<meta name = "viewport" content="width=device-width,initial-scale=1.0" />
<link href="../jquery/jquery.mobile-1.4.2.min.css" rel = "stylesheet" type = "text/css"></link>
<script type="text/javascript" src="../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../jquery/jquery.mobile-1.4.2.min.js"></script>
</head> 
<body>
	<div data-role="page" style="margin:0 auto;width:100%;background-color: #a0a0a0;">
       	<?php myheader();
		foreach($ques_arr as $as){
		    onenode($as,$dbObj);
		}
        
        ?>
	</div>


</body>
</html>