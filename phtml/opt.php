<?php
	header("Content-type:text/html;charset=utf-8");
	$password=$_POST['password'];
	if($password==''){
		$password = $_SESSION['password'];
	}
	if($password == ''){
		session_start();
	}

	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>�鱾����</title>
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
		<?php pass($password);?>
	</body>
</html>

<?php 
	
	function pass($password){
		$time = md5(date('Ymd',time()));
		if($time == $password){//��֤ͨ��
			$_SESSION['password']=$password;
			studynum();
		}else{
			passform();
		}
	}
	
	function studynum(){//ѧ�������
		$id=$_POST['id'];
		if($id==''){
			echo '<form action="" method="post">
			<label for="id">������ѧ��:</label><input type="text" name="id"/>
			<input type="submit" value="�ύ"/>
			</form>';
		}else{
			$_SESSION['id']=$id;
			
		}
		
	}
	
	function getInfo(){//�����Ϣ
		require_once '../connections/ocidb.php';
		$ocidb = new ocidb();
		$certid=$_SESSION['id'];
		$sql = "select * from cert_id='". $certid ."'";
		$ret = $ocidb->get_all($sql);
		echo '<table border="1" cellspacing="1" cellpadding="0">
			<tr><th>�鱾���</th><th>Ӧ������</th><th>�޸�</th><th>ɾ��</th></tr>';
		if(count($ret)!=0){
			foreach($ret as $retone){
				echo '<tr><td>'.$retone[1].'</td><td>'.$retone[3].'</td><td>'.modefyform($retone[3], $ocidb).'</td><td>'.delform($retone[3], $ocidb).'</td></tr>';
			}
		}
		echo '</table>';
		
	}
	
	function modefyform($booknum,ocidb $ocidb){
		$sqlstr='';
		if($_POST['type']=='mod'){
			$sqlstr="update lend_lst set renew_times=0,norm_ret_date='" . $_POST['booktime'] . "' where cert_id='" . $_SESSION['id'] . "' and prop_no='" . $_POST['bookid'] . "'";
			$ocidb->query($sqlstr);
			unset($_POST);
			getInfo();
		}else{
		echo '<form action="" method="post">
			<input type="hidden" name="bookid" value="'.$booknum.'"/>
			<input type="hidden" name="type" value="mod"/>
			<label for="booktime">��������</label><input type="text" name="booktime"/>
			<input type="submit" value="�޸�"/>
		</form>';
		}
		
	}
	
	function delform($booknum,ocidb $ocidb){
		$sqlstr='';
		if($_POST['type']=='del'){
			$sqlstr="delete lend_lst where cert_id='" . $_SESSION['id'] . "' and prop_no='" . $_POST['bookid'] . "'";
			$ocidb->query($sqlstr);
			unset($_POST);
			getInfo();
		}else{
			echo '<form action="" method="post">
				<input type="hidden" name="bookid" value="'.$booknum.'"/>
				<input type="hidden" name="type" value="del"/>
				<input type="submit" value="ɾ��"/>
			</form>';
		}
	}
	
	function passform(){//������֤��
		echo '<form action="" method="post">
		  <input name="password" type="text" value="">
		  <input type="submit" value="��֤����"/>
		</form>';
	}
?>


