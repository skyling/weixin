<?php
	if(!isset($_SESSION)){
	    session_start();
	}
	$password=$_POST['password'];
	if($password==''){
		$password = $_SESSION['password'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>书本操作</title>
		<STYLE type="text/css">
			body{
				width:80%;
				height:auto;
				margin:auto;
				padding:0;
			}
		</STYLE>
	</head>
	<body>
		<?php
			clearC();
			pass($password);
		?>
	</body>
</html>

<?php 
	function pass($password){
		$time = md5(date('Ymd',time()));
		if($time == $password){//验证通过
			$cp = $_SESSION['password'];
			if( $cp == ''){
				$_SESSION['password']=$password;
			}			
			studynum($password);
		}else{
			passform();
		}
	}
	
	function studynum($password){//学号输入表单
		$id=$_POST['id'];
		if($id==''){
			$id=$_SESSION['id'];
		}
		if($id==''){
			echo '<form action="test.php" method="post"><label for="id">请输入学号:</label><input type="text" name="id" value=""/>	<input type="hidden" name="password" value="'.$password.'"/><input type="submit" value="提交"/></form>';
		}else{
			$_SESSION['id']=$id;
			getInfo();
		}
	}
	
	function getInfo($ocidb=null){//获得信息
		require_once '../connections/ocidb.php';
		if($ocidb==null){
			$ocidb = new ocidb();
		}
		$id=$_SESSION['id'];
		$password=$_SESSION['password'];
		$certid=$id;
		$sql = "select * from lend_lst where cert_id='". $certid ."'";
		$ret = $ocidb->get_all($sql);
		echo '<table border="1" cellspacing="1" cellpadding="0">
			<tr><th>书本编号</th><th>书本名称</th><th>应还日期</th><th>修改</th><th>删除</th></tr>';
		if(count($ret)!=0){
			for($i=0; $i<count($ret);$i++){
				$sql = "select MARC_REC_NO from item where PROP_NO='".$ret[$i][1]."'";
				$ret1 = $ocidb->get_one($sql);
				$sql = "select m_title from marc where MARC_REC_NO='".$ret1[0]."'";
				$ret2 = $ocidb->get_one($sql);
				$bookname=$ret2[0];
				$mod = modefyform($ret[$i][1],$ocidb);
				$del = delform($ret[$i][1], $ocidb);
				echo '<tr><td>'.$ret[$i][1].'</td><td>'.$bookname.'</td><td>'.$ret[$i][3].'</td><td>'.$mod.'</td><td>'.$del.'</td></tr>';
			}
		}
		echo '</table>';
	}
	
	function modefyform($booknum,ocidb $ocidb){
		$sqlstr='';
		$id=$_SESSION['id'];
		$password=$_SESSION['password'];
		if($_POST['type']=='mod'){
			$sqlstr="update lend_lst set renew_times=0,NORM_RET_DATE='" . $_POST['booktime'] . "' where cert_id='" . $id . "' and prop_no='" . $_POST['bookid'] . "'";
			$ocidb->query($sqlstr);
			$_POST['type']='';
		}
		return '<form action="test.php" method="post">
			<input type="hidden" name="password" value="'.$password.'"/>
			<input type="hidden" name="id" value="'.$id.'"/>
			<input type="hidden" name="bookid" value="'.$booknum.'"/>
			<input type="hidden" name="type" value="mod"/>
			<label for="booktime">还书日期</label><input type="text" name="booktime"/>
			<input type="submit" value="修改"/>
		</form>';
		
		
	}
	
	function delform($booknum,ocidb $ocidb){
		$sqlstr='';
		$id=$_SESSION['id'];
		$password=$_SESSION['password'];
		if($_POST['type']=='del'){
			$sqlstr="delete lend_lst where cert_id='" . $_SESSION['id'] . "' and prop_no='" . $_POST['bookid'] . "'";
			$ocidb->query($sqlstr);
			$_POST['type']='';
		}
			return '<form action="test.php" method="post">
				<input type="hidden" name="password" value="'.$password.'"/>
			<input type="hidden" name="id" value="'.$id.'"/>
				<input type="hidden" name="bookid" value="'.$booknum.'"/>
				<input type="hidden" name="type" value="del"/>
				<input type="submit" value="删除"/>
			</form>';
	}
	
	function passform(){//密码验证表单
		echo '<form action="test.php" method="post">
		  <input name="password" type="text" value="">
		  <input type="submit" value="验证密码"/>
		</form>';
	}
	
	function clearC(){
		$quit = $_POST['quit'];
		if($quit!=''){
			session_unset();
		}else{
			echo '<form action="test.php" method="post">
		  <input name="quit" type="hidden" value="quit">
		  <input type="submit" value="注销"/>修改后请刷新显示
		</form>';
		}
	}
?>