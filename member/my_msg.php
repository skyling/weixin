<?php
Function my_msg($msg,$redirect){
	echo "<script language=\"javascript\" charset=\"utf-8\">";
	echo "window.alert('".$msg."')";
	echo "</script>";
	echo "<script language=\"javascript\">";
	echo "location.href='".$redirect."'";
	echo "</script>";
}
Function my_redir($redirect){
	echo "<script language=\"javascript\">";
	echo "location.href='".$redirect."'";
	echo "</script>";
}
Function my_msgbox($msg){
	echo "<script language=\"javascript\" charset=\"utf-8\">";
	echo "window.alert('".$msg."')";
	echo "</script>";
}

?>