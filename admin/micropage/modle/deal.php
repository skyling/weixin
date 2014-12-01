<?php
	require_once './../../../connections/mydb.php';
	date_default_timezone_get('PRC');
	
	$dbObj = new mydb();
	if (isset($_GET['type'])) {
		switch ($_GET['type']) {
			case 'qr':
				$data_arr = array('person'=>$_GET['person'] , 'libQid'=>$_GET['serial'] , 'content'=>$_GET['content'] , 'atime'=>date("Y-m-d H:i:s" , time()));
				if($dbObj->insert($_GET['table'] , $data_arr)){
					if ($dbObj->update("libQuestion" , array('isSolve'=>'1') , "serial=".$_GET['serial']."")) {
						echo '<script type="text/javascript">location.href="./lookInfo.php?type=qr&serial='.$_GET['serial'].'"</script>';
					}else{
						echo '回答失败！';
						return false;
					}
				}else{
					echo '回答失败！';
					return false;
				}
				break;

			case 'sh':
				if($dbObj->update($_GET['table'] , array('isChecked'=>'1') , "serial=".$_GET['serial']."")){
					echo '<script type="text/javascript">location.href=document.referrer;</script>';
				}else{
					echo '回答失败！';
					return false;
				}
				break;
			
			default:
				break;
		}

	}else{
		echo '处理异常！';
	}
?>