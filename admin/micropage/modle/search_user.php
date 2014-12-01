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
				用户管理
			</div>
			<div class="Tright">
				<form action="./search_user.php" target="rightContext">
					学号：<input type="text" name="stu_id" />
					<input type="submit" value="查询" />
				</form>
			</div>
		</div>
		<div class="context">
			<?php
				require_once './../../../connections/mydb.php';
				require_once './../../class/page.class.php';
				date_default_timezone_get('PRC');
				$dbObj=new mydb();
				if ($_GET['stu_id'] != "") {
					$sql = "select open_id from lib_user where stu_id='".$_GET['stu_id']."'";
				}else{
					$sql = "select open_id from lib_user";
				}
				$ans_arr = $dbObj->get_all($sql);
				if ($ans_arr) {
					$total = count($ans_arr);
					$ans_arr = null;
					$page = new Page($total, 14, "&pa=");
					if ($_GET['stu_id'] != "") {
						$sql="select * from lib_user where stu_id='".$_GET['stu_id']."' {$page->limit}";
					}else{
						$sql="select * from lib_user {$page->limit}";
					}
					$ans_arr = $dbObj->get_all($sql);
					echo "<table cellspacing='0' cellpadding='0'>";
					echo "<tr class='tr1'>";
					echo "<td>序号</td>";
					echo "<td>OpenID</td>";
					echo "<td>姓名</td>";
					echo "<td>学号</td>";
					echo "<td>绑定状态</td>";
					echo "<td>关注状态</td>";
					echo "<td>关注时间</td>";
					echo "<td>操作</td>";
					echo "</tr>";
					foreach ($ans_arr as $value) {
						echo "<tr class='tr2'>";
						echo "<td>".$value[0]."</td>";
						echo "<td>".$value[1]."</td>";
						echo "<td>".$value[6]."</td>";
						echo "<td>".$value[3]."</td>";
						if ($value[2] == 0) {
							echo "<td>未绑定</td>";
						}else{
							echo "<td>绑定</td>";
						}
						if ($value[4] == 0) {
							echo "<td>未关注</td>";
						}else{
							echo "<td>关注</td>";
						}
						echo "<td>".$value[5]."</td>";
						echo "<td><a href='####'>修改</a>&nbsp;|&nbsp;<a href='####'>删除</a></td>";
						echo "</tr>";
					}
					echo "</table>";
					echo '<div id="page_num">'.$page->fpage(array(3,4,5,6,7,8,0)).'</div>';
				}else{
					echo '没有数据被找到！';
				}
			?>
		</div>
	</body>
</html>