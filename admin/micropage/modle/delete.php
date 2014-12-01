<?php
	require_once '../../../connections/mydb.php';

	if (isset($_GET['type'])) {
		$front_str='lib_';
		switch ($_GET['type']) {
			case 'cmd':
				if (isset($_GET['serial'])) {
					$dbObj=new mydb();
					if($dbObj->delete($front_str.$_GET['type'] , "serial=".$_GET['serial']."")){
						if($dbObj->delete($front_str.'content' , "con_cmd='".$_GET['key']."'")) {
							echo '<script type="text/javascript">location.href="./../lib_cmd.php";</script>';
						}else{
							echo 'delete failed!';
						}
					}else{
						echo 'delete failed!';
					}
				}else{
					echo 'delete failed!';
				}
				break;

			case 'qr':
				if (isset($_GET['serial'])) {
					$dbObj=new mydb();
					if($dbObj->delete("libQuestion" , "serial=".$_GET['serial']."")){
						if($dbObj->delete("libReply" , "libQid=".$_GET['serial']."")) {
							echo '<script type="text/javascript">location.href="./../lib_qr.php";</script>';
						}else{
							echo 'delete failed!';
						}
					}else{
						echo 'delete failed!';
					}
				}else{
					echo 'delete failed!';
				}
				break;
			
			default:
				# code...
				break;
		}
	}else{
		echo 'wrong operation!';
	}
?>