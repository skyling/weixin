<?php
/**
 * 新生入馆教育数据获取与设置
 * skyling
 * 2014.09.12
 */
require_once 'connections/ocidb.php';
$objoci = new ocidb();
//$type=$_POST['type'];
//$cert_id = $_POST['cert_id'];
//$username = $_POST['name'];
$type='get';
$cert_id='14113901091';
$username='李富仁';
include("../libtrain/admin/global.php");
if($cert_id==''||$type==''){
	$r_status = '0';
}else{
	if($type=='get'){
		$sql = "select cert_id,name,password from reader where cert_id='".$cert_id."' and name='".$username."'";
		echo $sql."<br>";
		$ret = $objoci->get_one($sql);
		print_r($ret);
		if ($ret[0]=='') {
			$r_status = '0';
		}else {
			$r_status='1';
			$sql = "select * from test_uesr";
			echo $sql;
			$ret = $db->query($sql);
			$sql = "insert into test_user(cert_id,name,mark,flag) values('".$ret[0]."','".$ret[1]."',0,0)";
			echo "<br>".$sql;
			$db->query($sql);
			
		}
	}
	if($type=='set'){
		$sql = "update reader_cert set cert_flag=1 where cert_id='".$cert_id."'";
		$ret = $objoci->query($sql);
		if($ret){
			$r_status='1';
		}else{
			$r_status='0';
		}
	}	
}
echo "<root>
		<status>$r_status</status>
      </root>";
