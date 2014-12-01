<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>湖南理工图书馆微信后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="../style/micropage.css">
	</head>
	<body>
		<div class="top">
			<div class="Tleft">
				命令管理
				<a href="javascript:void(0);" onclick="window.location.href='./modle/add.php?type=cmd';"><input type="button" value="增加命令"></a>
			</div>
			<div class="Tright">
				<form action="./modle/search.php" target="rightContext">
					<input type="text" name="con" />
					<input type="submit" value="查询" />
				</form>
			</div>
		</div>
		<div class="context">
			<?php
				require_once '../../connections/mydb.php';
				require_once '../class/page.class.php';
				date_default_timezone_get('PRC');
				$dbObj=new mydb();
				$sql = "select cmd_key from lib_cmd";
				$ans_arr = $dbObj->get_all($sql);
				if ($ans_arr) {
					$total = count($ans_arr);
					$ans_arr = null;
					$page = new Page($total, 14, "&pa=");
					$sql="select * from lib_cmd {$page->limit}";
					$ans_arr = $dbObj->get_all($sql);
					echo "<table cellspacing='0' cellpadding='0'>";
					echo "<tr class='tr1'>";
					echo "<td>序号</td>";
					echo "<td>命令</td>";
					echo "<td>类型</td>";
					echo "<td>标记</td>";
					echo "<td>操作</td>";
					echo "</tr>";
					foreach ($ans_arr as $value) {
						echo "<tr class='tr2'>";
						echo "<td>".$value[0]."</td>";
						echo "<td><a href='./modle/modify.php?type=cmd&serial=".$value[0]."&key=".$value[1]."'>".$value[1]."</a></td>";
						echo "<td>".$value[2]."</td>";
						echo "<td>".$value[3]."</td>";
						echo "<td><a href='./modle/add.php?type=add_key_content&key=".$value[1]."'>增加内容</a>&nbsp;|&nbsp;<a href='./modle/modify.php?type=cmd&serial=".$value[0]."&key=".$value[1]."'>修改</a>&nbsp;|&nbsp;<a href='./modle/delete.php?type=cmd&serial=".$value[0]."&key=".$value[1]."'>删除</a></td>";
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