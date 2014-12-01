<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>湖南理工图书馆微信后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="../../style/micropage.css">
	</head>
	<body>
		<div class="top">
			<div class="Tleft">
				问题详情
			</div>
		</div>
		<div class="context">
			<?php
				require_once './../../../connections/mydb.php';
				date_default_timezone_get('PRC');
				$dbObj=new mydb();
				if (isset($_GET['serial'])) {
					$sql = "select * from libQuestion where serial=".$_GET['serial']."";
					$ans_arr = $dbObj->get_all($sql);
					if ($ans_arr) {
						$sh = ($ans_arr[0][5] == 1) ? '已审核' : '未审核';
						$hd = ($ans_arr[0][6] == 1) ? '已回答' : '未回答';
						$Qserial = $ans_arr[0][0];
						echo '<div class="lookInfo">';
						echo '<hr />';
						echo "问题编号：".$ans_arr[0][0]."&nbsp;&nbsp;&nbsp;&nbsp;问题类型：".$ans_arr[0][4]."&nbsp;&nbsp;&nbsp;&nbsp;".$sh."&nbsp;&nbsp;&nbsp;&nbsp;".$hd."<br />";
						echo "提问者：".$ans_arr[0][1]."&nbsp;&nbsp;&nbsp;&nbsp;提问时间：".$ans_arr[0][2]."<br />";
						echo "问题内容：".$ans_arr[0][3]."";
						echo "<hr />";
						$ans_arr = null;
						$sql = "select * from libReply where libQid=".$_GET['serial']."";
						$ans_arr = $dbObj->get_all($sql);
						if ($ans_arr) {
							foreach ($ans_arr as $key => $value) {
								$first_br = ($key == 0) ? '' : '<br /><br />';
								echo "".$first_br."答案编号：".$value[0]."<br />";
								echo "回答者：".$value[1]."&nbsp;&nbsp;&nbsp;&nbsp;回答时间：".$value[3]."<br />";
								echo "答案内容：".$value[4]."";
							}
						}else{
							echo "问题还没有被回答，您可以在此处回答<br /><form action='deal.php'>";
							echo "<input type='hidden' name='type' value='qr' />";
							echo "<input type='hidden' name='table' value='libReply' />";
							echo "<input type='hidden' name='serial' value='".$Qserial."' />";
							echo "您的姓名：<input type='text' name='person' value='".$_SESSION['username']."' readonly='true' /><br />";
							echo "答案内容：<textarea name='content' cols='40' rows='3'></textarea><br />";
							echo "<input type='submit' />&nbsp;&nbsp;<input type='reset' value='重置' />";
							echo "</form>";
						}
						echo '</div>';
					}else{
						echo '没有数据！';
					}
				}else{
					echo '查找数据失败！';
				}
			?>
		</div>
	</body>
</html>