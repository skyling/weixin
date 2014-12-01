<?php
/**
 * 提交一对一服务中问题
 */
require_once './class/libQuestion.php';
$person = $_GET['openid'];
$content = $_POST['content'];

$libQObj = new libQuestion($person);
$libQObj->setContent($content);
$libQObj->insetInfo();

?>