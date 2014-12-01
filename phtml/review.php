<?php
include_once '../connections/ocidb.php';
$review = $_POST['review'];
$stuid = $_POST['stuid']; 
$openid = $_POST['openid'];
$marc = $_POST['marc'];
if (empty($review)) {
	echo "评论不能为空！<br>";
	echo '<a href="javascript:window.history.go(-1)"><input type="button" value="返回"></a>';
	
}else{
	$objoci = new ocidb();
	$time = date('Y-m-d H:i:s',time());
	$sql = "insert into book_review(marc_rec_no,cert_id,review_content,review_date) values('$marc','$stuid','$review','$time')";
	$objoci->query($sql);
	echo "<script>window.location='http://lib.hnist.cn/weixin/phtml/bookreview.php?openid={$openid}'</script>";
}
?>

