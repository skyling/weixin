<?php
require_once 'connections/ocidb.php';
$ociobj = new ocidb();

$sql = "select * from lend_lst";
$ret = $ociobj->get_one($sql);
print_r($ret);
echo "<br>";
$sql = "select * from Item";
$ret = $ociobj->get_one($sql);
print_r($ret);
echo "<br>";

$sql = "select * from marc";
$ret = $ociobj->get_one($sql);
print_r($ret);
echo "<br>";

?>
