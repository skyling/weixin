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
				问答管理
			</div>
			<div class="Tright">
				<form action="./modle/search_qr.php" target="rightContext">
					<input type="text" name="key_word" />
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
				$sql = "select serial from libQuestion";
				$ans_arr = $dbObj->get_all($sql);
				if ($ans_arr) {
					$total = count($ans_arr);
					$ans_arr = null;
					$page = new Page($total, 14, "&pa=");
					$sql="select * from libQuestion {$page->limit}";
					$ans_arr = $dbObj->get_all($sql);
					echo "<table cellspacing='0' cellpadding='0'>";
					echo "<tr class='tr1'>";
					echo "<td>序号</td>";
					echo "<td>内容</td>";
					echo "<td>提问者</td>";
					echo "<td>提问时间</td>";
					echo "<td>问题类型</td>";
					echo "<td>审核</td>";
					echo "<td>解决</td>";
					echo "<td>操作</td>";
					echo "</tr>";
					foreach ($ans_arr as $value) {
						echo "<tr class='tr2'>";
						echo "<td>".$value[0]."</td>";
						echo "<td>".$value[3]."</td>";
						echo "<td>".$value[1]."</td>";
						echo "<td>".$value[2]."</td>";
						echo "<td>".$value[4]."</td>";
						if ($value[5] == 0) {
							echo "<td>未审核</td>";
							$sh_link_status="";
						}else{
							echo "<td>已审核</td>";
							$sh_link_status="return false";
						}
						if ($value[6] == 0) {
							echo "<td>未回答</td>";
						}else{
							echo "<td>已回答</td>";
						}
						echo "<td><a href='./modle/deal.php?type=sh&table=libQuestion&serial=".$value[0]."' onclick='".$sh_link_status."'>审核</a>&nbsp;|&nbsp;<a href='./modle/lookInfo.php?type=qr&serial=".$value[0]."'>查看</a>&nbsp;|&nbsp;<a href='./modle/delete.php?type=qr&serial=".$value[0]."'>删除</a></td>";
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