<?php
require_once '../connections/ocidb.php';
$ocidb = new ocidb();
/*
$certid = '14113901091';

$sql = "select * from item where PROP_NO='Z0681243'";

$ret = $ocidb->get_one($sql);
print_r($ret);
*/
$certid='14113901091';
$propno='Z1240135';
$date22='2014-09-16';
$ocidb->query("update lend_lst set renew_times=0,norm_ret_date='" . $date22 . "'  where cert_id='" . $certid . "' and prop_no='" . $propno . "'");

/*
$sql = "select count(*) from lend_lst where cert_id='".$certid."' and NORM_RET_DATE<='2014-10-08'";
$ret = $ocidb->get_one($sql);
echo "<br>".$ret[0];*/
?>
