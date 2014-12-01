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
				命令管理
				<a href="javascript:void(0);" onclick="window.location.href='add.php?type=cmd';"><input type="button" value="增加命令"></a>
			</div>
			<div class="Tright">
				<form action="./search.php" target="rightContext">
					<input type="text" name="con" />
					<input type="submit" value="查询" />
				</form>
			</div>
		</div>
		<div class="context">
			<?php
				require_once '../../../connections/mydb.php';
				require_once '../../class/page.class.php';
				date_default_timezone_get('PRC');
				$dbObj=new mydb();
				$sql = "select * from lib_cmd where cmd_key like '%".$_GET['con']."%'";
				$ans_arr1 = $dbObj->get_all($sql);
				$total1 = count($ans_arr1);
				$sql = "select * from lib_cmd where cmd_type like '%".$_GET['con']."%'";
				$ans_arr2 = $dbObj->get_all($sql);
				$total2 = count($ans_arr2);
				$sql = "select * from lib_cmd where cmd_remark like '%".$_GET['con']."%'";
				$ans_arr3 = $dbObj->get_all($sql);
				$total3 = count($ans_arr3);
				$ans_arr = array_merge($ans_arr1,$ans_arr2,$ans_arr3);
				if ($ans_arr) {
					echo "<table cellspacing='0' cellpadding='0'>";
					echo "<tr class='tr1'>";
					echo "<td>序号</td>";
					echo "<td>命令</td>";
					echo "<td>类型</td>";
					echo "<td>标记</td>";
					echo "<td>操作</td>";
					echo "</tr>";
					for ($i = 0 ; $i < count($ans_arr) ; $i++) {
						echo "<tr class='tr2'>";
						echo "<td>".$ans_arr[$i][0]."</td>";
						echo "<td><a href='./modify.php?type=cmd&serial=".$ans_arr[$i][0]."&key=".$ans_arr[$i][1]."'>".$ans_arr[$i][1]."</a></td>";
						echo "<td>".$ans_arr[$i][2]."</td>";
						echo "<td>".$ans_arr[$i][3]."</td>";
						echo "<td><a href='./add.php?type=add_key_content&key=".$ans_arr[$i][1]."'>增加内容</a>&nbsp;|&nbsp;<a href='./modify.php?type=cmd&serial=".$ans_arr[$i][0]."&key=".$ans_arr[$i][1]."'>修改</a>&nbsp;|&nbsp;<a href='./delete.php?type=cmd&serial=".$ans_arr[$i][0]."&key=".$ans_arr[$i][1]."'>删除</a></td>";
						echo "</tr>";
					}
					echo "</table>";
				}else{
					echo '<br /><br /><hr>未找到对应的数据！';
				}
			?>
		</div>
	</body>
</html>