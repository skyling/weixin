<?php
	if (isset($_POST['table'])) {
		require_once '../../../connections/mydb.php';
		require_once '../../class/FileUpload_one.class.php';
		$dbObj = new mydb();
		switch ($_POST['table']) {
			case 'lib_cmd':
				$data_arr = array('cmd_key'=>$_POST['cmd_key'] , 'cmd_type'=>$_POST['cmd_type'] , 'cmd_remark'=>$_POST['cmd_remark']);
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

				$up=new FileUpload_one(array('allowtype'=>array('jpg','jpeg'),'filepath'=>'./../../../images','israndname'=>false));
				if($up->uploadFile('picurl')){
					//return true;
				}
				else{
					echo $up->getErrorMsg();
				}
				$data_arr = array('con_cmd'=>$_POST['con_cmd'] , 'con_content'=>$_POST['con_content'] , 'title'=>$_POST['title'] , 'description'=>$_POST['description'] , 'picurl'=>$_POST['picurl'] , 'url'=>$_POST['url']);
				break;
			
			default:
				echo '数据异常！';
				break;
		}
		if($dbObj->insert($_POST['table'] , $data_arr)){
			echo "<script type='text/javascript'>alert('增加成功！');window.location.href='./../lib_cmd.php';</script>";
		}else{
			echo "<script type='text/javascript'>alert('增加命令失败，请重试！');window.hihstory.back(-1);</script>";
		}
	}
	else{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>湖南理工图书馆微信后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="../../style/micropage.css">
	</head>
	<body>
		<?php
			switch ($_GET['type']) {
				case 'cmd':
					$window_title = '增加命令';
					$window_text = '
									<input type="hidden" name="table" value="lib_cmd" />
									键值：<input type="text" name="cmd_key" /><br /><br />
									类型：<select name="cmd_type">
											  <option selected="selected" value="none">请选择</option>
											  <option value="text">text</option>
											  <option value="news">news</option>
										  </select><br /><br />
									标记：<input type="text" name="cmd_remark" /><br /><br />
									<input type="submit" value="增加" />&nbsp;&nbsp;
									<input type="reset" value="重置" />
								';
					break;

				case 'add_key_content':
					$window_title = '增加命令内容';
					$window_text = '
									<input type="hidden" name="table" value="lib_content" />
									<input type="hidden" name="con_cmd" value="'.$_GET['key'].'" />
									标&nbsp;&nbsp;&nbsp;题：<input type="text" name="title" style="width:300px;" /><br /><br />
									内&nbsp;&nbsp;&nbsp;容：<textarea name="con_content" rows="3" cols="40"></textarea><br /><br />
									描&nbsp;&nbsp;&nbsp;述：<textarea name="description" rows="3" cols="40"></textarea><br /><br />
									页面URL：<input type="text" name="url" style="width:300px;" /><br /><br />
									<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
									请选择上传图片：<input type="file" name="picurl" /><br /><br />
									<input type="submit" value="增加" />&nbsp;&nbsp;
									<input type="reset" value="重置" />
									';
					break;
				
				default:
					$window_title='';
					break;
			}
		?>
		  <div class="top">
			<div class="Tleft">
				<?php echo $window_title;?>
			</div>
			<div class="Tright"></div>
		</div>
		<div class="context">
			<hr />
			<p align="left">
				<form action="./add.php" method="post"  enctype='multipart/form-data'>
					<?php echo $window_text;?>
				</form>
			</p>
		</div>
	</body>
</html>
<?php
	}
?>