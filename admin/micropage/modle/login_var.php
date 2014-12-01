<?php
	session_start();
	// header("Content-Type:text/xml;charset=utf-8");
	header("Cache-Control:no-cache");

	//sleep(3);
	$data_arr = explode(";" , $_POST['data']);

	$username =  $data_arr[0];
	$password = $data_arr[1];
	require_once '../../../connections/mydb.php';;
	if ($username == "" || $password == "") {
		echo "nullError";
	}else if(strlen($username) > 16 || strlen($password) > 18 || strlen($password) < 8){
		echo "lengthError";
	}else{
		$dbObj = new mydb();
		$sql = "select * from lib_admin_user where username = '".$username."'";
		$result=$dbObj->get_one($sql);
		if ($result) {
			//找到用户
			if ($result[2] == md5($password)) {
				$_SESSION["username"] = $result[1];
				$_SESSION["type"] = $result[5];
				echo "done";
			}else{
				echo "passwordError";
			}
		}else{
			echo "usernameError";
		}
	}
?>