<?php
	require_once '../../../connections/mydb.php';
	require_once '../../class/FileUpload_one.class.php';
	$dbObj=new mydb();

	 if (isset($_POST['table'])) {
		switch ($_POST['table']) {
			case 'lib_cmd':
				$data_arr=array('cmd_key'=>$_POST['cmd_key'] , 'cmd_type'=>$_POST['cmd_type'] , 'cmd_remark'=>$_POST['cmd_remark']);
				break;
			case 'lib_content':
				$serverName='http://lib.hnist.cn/weixin/images/'; 
				$_POST['picurl']=$serverName.$_FILES['picurl']['name'];
				//上传

				//权限测试
				if(!is_writable('./../../../images')){
					echo "Deny to access!";
					return false;
				}

				if ($_FILES['picurl']['name'] != "") {
					$up=new FileUpload_one(array('allowtype'=>array('jpg','jpeg'),'filepath'=>'./../../../images','israndname'=>false));
					if($up->uploadFile('picurl')){
						//return true;
					}
					else{
						echo $up->getErrorMsg();
					}
					$data_arr=array('con_content'=>$_POST['con_content'] , 'title'=>$_POST['title'] , 'description'=>$_POST['description'] , 'picurl'=>$_POST['picurl'] , 'url'=>$_POST['url']);
				}else{
					$data_arr=array('con_content'=>$_POST['con_content'] , 'title'=>$_POST['title'] , 'description'=>$_POST['description'] , 'url'=>$_POST['url']);
				}
				
				break;
			default:
				break;
		}
		if (isset($_POST['serial'])) {
			if($dbObj->update($_POST['table'] , $data_arr , "serial = '".$_POST['serial']."'")){
				$key_value=$_POST['cmd_key'];
				if ($_POST['table']=='lib_cmd') {
					if ($dbObj->update("lib_content" , array('con_cmd'=>$_POST['cmd_key']) , "con_cmd = '".$_POST['old_key']."'")) {
						// echo 'success!';
						// return true;
					}else{
						echo $_POST['cmd_key'].'对应的内容下键值更新失败！';
						return false;
					}
				}
				/*echo '<pre>';
				print_r($_FILES);
				echo '</pre>';*/
				echo '<script type="text/javascript">location.href="modify.php?type=cmd&serial='.$_POST['serial'].'&key='.$key_value.'"</script>';
			}else{
				echo 'modify failed!';
			}
		}else{
			echo 'modify failed!';
		}
	}else{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>湖南理工图书馆微信后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="../../style/micropage.css">
	</head>
	<body>
		<?php
			$tmp_key=null;
			if (isset($_GET['key'])) {
				$tmp_key=$_GET['key'];
			}else{
				$tmp_key=$_POST['key'];
			}
			$sql = "select * from lib_cmd where cmd_key = '".$tmp_key."'";
			$tmp_key=null;
			$ans_arr = $dbObj->get_all($sql);
			if ($ans_arr) {
				echo "<div class='modiv'>";
				echo "<form action='modify.php' method='post'>";
				echo "<input type='hidden' name='table' value='lib_cmd' />";
				echo "<input type='hidden' name='serial' value='".$ans_arr[0][0]."' />";
				echo "<input type='hidden' name='old_key' value='".$ans_arr[0][1]."' />";
				echo "键值:<input type='text' name='cmd_key' value='".$ans_arr[0][1]."' />&nbsp;";
				$typeFlag=$ans_arr[0][2];
				switch ($ans_arr[0][2]) {
					case 'text':
						$option='<option selected="selected" value="text">text</option><option value="news">news</option>';
						break;
					case 'news':
						$option='<option value="text">text</option><option selected="selected" value="news">news</option>';
						break;
					default:
						break;
				}
				echo '类型:<select name="cmd_type">';
				echo $option;
				echo '</select>&nbsp;';
				echo "标记:<input type='text' name='cmd_remark' value='".$ans_arr[0][3]."' />&nbsp;";
				echo "<input type='submit' value='修改'>";
				echo "</form>";
				echo "</div>";
			}else{
				echo '<div class="modiv">未找到该命令！</div>';
			}
			$ans_arr=null;
			if (isset($_GET['key'])) {
				$tmp_key=$_GET['key'];
			}else{
				$tmp_key=$_POST['key'];
			}
			$sql = "select * from lib_content where con_cmd = '".$tmp_key."'";
			$tmp_key=null;
			$ans_arr = $dbObj->get_all($sql);
			if ($ans_arr) {
				foreach ($ans_arr as $key => $value) {
					echo "<div class='modiv'>";
					echo "<form action='modify.php' method='post' enctype='multipart/form-data'>";
					echo "<input type='hidden' name='table' value='lib_content' />";
					echo "<input type='hidden' name='serial' value='".$value[0]."' />";
					echo "<input type='hidden' name='cmd_key' value='".$value[1]."' />";
					echo "标&nbsp;&nbsp;&nbsp;题:<input type='text' name='title' value='".$value[3]."' style='width:300px;' /><br /><br />";
					if ($typeFlag=='text') {
						echo "内&nbsp;&nbsp;&nbsp;容:<textarea cols='40' rows='3' name='con_content'>".$value[2]."</textarea><br /><br />";
					}
					echo "描&nbsp;&nbsp;&nbsp;述:<input type='text' name='description' value='".$value[4]."' style='width:300px;' /><br /><br />";
					echo "页面URL:<input type='text' name='url' value='".$value[6]."' style='width:300px;' /><br /><br />";
					echo "图片URL:<input type='text' name='psrc' value='".$value[5]."' style='width:300px;' readonly='true' /><br /><br />";
					echo '<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />';
					echo '请选择上传图片：<input type="file" name="picurl" style="width:300px;"><br />';
					echo "<input type='submit' value='修改'>";
					echo "</form>";
					echo "</div>";
				}
			}else{
				echo '<div class="modiv">当前命令下没有对应的内容！</div>';
			}
		?>
	</body>
</html>
<?php }?>