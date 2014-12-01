<?php
$openid=$_GET['openid'];
include_once '../connections/ocidb.php';
include_once '../connections/mydb.php';
include_once '../class/lib_user.php';
$sqlObj = new mydb();
$objUser=new lib_user($openid, $sqlObj);
$stat = $objUser->getStatus();
$i=0;
function reviewpage($rs,$objoci,$openid,$certid){
	if(count($rs)>0){
		//print_r($rs);
		/*Array ( [0] => Array ( [0] => 0000341499 ) [1] => Array ( [0] => 0000353317 ) [2] => Array ( [0] => 0000345139 ) [3] => Array ( [0] => 0000352232 ) [4] => Array ( [0] => 0000345292 ) [5] => Array ( [0] => 0000345237 ) [6] => Array ( [0] => 0000122133 ) [7] => Array ( [0] => 0000095222 ) [8] => Array ( [0] => 0000343289 ) [9] => Array ( [0] => 0000122133 ) [10] => Array ( [0] => 0000345177 ) [11] => Array ( [0] => 0000300201 ) [12] => Array ( [0] => 0000121275 ) [13] => Array ( [0] => 0000409073 ) [14] => Array ( [0] => 0000307613 ) [15] => Array ( [0] => 0000121275 ) [16] => Array ( [0] => 0000217029 ) [17] => Array ( [0] => 0000135055 ) [18] => Array ( [0] => 0000121867 ) [19] => Array ( [0] => 0000139195 ) [20] => Array ( [0] => 0000147263 ) [21] => Array ( [0] => 0000188046 ) [22] => Array ( [0] => 0000188035 ) [23] => Array ( [0] => 0000335710 ) [24] => Array ( [0] => 0000149391 ) [25] => Array ( [0] => 0000341430 ) [26] => Array ( [0] => 0000134674 ) [27] => Array ( [0] => 0000141693 ) [28] => Array ( [0] => 0000300179 ) [29] => Array ( [0] => 0000135321 ) [30] => Array ( [0] => 0000256814 ) [31] => Array ( [0] => 0000291866 ) [32] => Array ( [0] => 0000293208 ) [33] => Array ( [0] => 0000309221 ) [34] => Array ( [0] => 0000141774 ) [35] => Array ( [0] => 0000150415 ) [36] => Array ( [0] => 0000218813 ) [37] => Array ( [0] => 0000131015 ) [38] => Array ( [0] => 0000232362 ) [39] => Array ( [0] => 0000359760 ) [40] => Array ( [0] => 0000359773 ) )
		 * */
		//echo $re[0][0];  0000341499   //图书编号
		for($i=0;$i<count($rs);$i++){
			$counts = count($rs);
			$sql = "select m_title from marc where marc_rec_no='{$rs[$i][0]}'";
			$rs1 = $objoci->get_one($sql);
			//$rs1[0];书名
			// echo $rs1[0];  Ajax关键技术与典型案例
			//		echo "-------------------------------------------------<br>";
			echo "<div style='margin:3px auto;width:90%;background-color:white;border:1px solid black;'><b>".($i+1).".{$rs1[0]}</b><br><sub>借阅日期:{$rs[$i][1]}</sub><br>";

			//		echo $rs1[0]."借书日期:".$rs[$i][1]."<br>";
			$sql = "select * from book_review where marc_rec_no='{$rs[$i][0]}'";
			$rs2 = $objoci->get_all($sql);
			echo "<div style='width:100%;border:1px solid #aaa'>";
			if (count($rs2)>0) {
				//获得书评
					
				for($j=0;$j<count($rs2);$j++){
					$sql  = "select name from reader where cert_id='{$rs2[$j][1]}'";
					$rs3 = $objoci->get_one($sql);
					
					echo "<b><font size='-1'>{$rs2[$j][2]}</font></b><br>";
					echo "<span style='font-size:12px;'>{$rs3[0]}   {$rs2[$j][3]}</span>";
					echo "<div style='width:100%;height:0px;border:1px solid #aaa'></div>";
					//echo $rs3[0];//李富仁
					//		echo $rs3[0]."   ".$rs2[$j][3]."<br>".$rs2[$j][2].'<br>';
				}
				
					
					

			}else {
				echo "暂无评论<br>";
			}
			reviewform($openid, $rs[$i][0],$certid);
			echo "</div>";
		}
	}
}

	function reviewform($openid,$marc,$certid){
		echo "<form name='form' method='post' action='review.php'>
		<textarea cols=30 id='review' name='review' placeholder='请写出对此书的评论...'></textarea>
		<input name='stuid' type='hidden' value='{$certid}'/>
		<input name='marc' type='hidden' value='{$marc}' />
		<input name='openid' type='hidden' value='{$openid}' />
		<input type='submit'  value='我要评论' />
		</form>";
		echo "</div>";
}
if($stat!=1){
//	echo "<script>window.close();alert('请先绑定账号!回复4即可进行绑定!');</script>";
	echo "<h1>请先返回微信聊天界面回复【4】绑定账号!<h1>";
	exit(1);
}
$objoci = new ocidb();
$certid = $objUser->getStu_id();
$sql  = "select marc_rec_no_f,lend_date from lend_hist where cert_id_f='{$certid}' order by lend_date desc";
$rs = $objoci->get_all($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
<meta name = "viewport" content="width=device-width,initial-scale=1.0" />
<!-- <link href="../jquery/jquery.mobile-1.4.2.min.css" rel = "stylesheet" type = "text/css"></link>
<script type="text/javascript" src="../jquery/jquery-2.0.2.js"></script>
<script type="text/javascript" src="../jquery/jquery.mobile-1.4.2.min.js"></script> -->
</head> 
</head>
<body style="margin:0 0;padding：0px;width:100%;background-color: #a0a0a0;">
<center><h3>书籍评论</h3></center>
<?php 	reviewpage($rs,$objoci,$openid,$certid);?>
</body>
</html>