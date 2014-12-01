<?php 
	require_once '../../connections/mydb.php';
	date_default_timezone_get('PRC');
	$dbObj=new mydb();

	function read_config_file($filename){
		$file_arr=array();
		$f = fopen ($filename, "r");
		$ln= 0;
		while (! feof ($f)) {
		    $line= fgets ($f);
		    ++$ln;
		    if ($line===FALSE) {
		    	//$file_arr="";
		    }else{
		    	$file_arr[]=$line;
		    }
		}
		fclose ($f);
		return $file_arr;
	}

	function write_config_file($filename , $context_arr){
		$f = fopen ($filename, "w");
		if($f){
			for ($i=0; $i < count($context_arr); $i++) { 
				if (!fwrite($f,$context_arr[$i]."\r\n")) {
					echo "写入文件失败";
					return false;
				}
			}
		}else { 
			echo "打开文件失败！"; 
		} 
		fclose($f);
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<title>湖南理工图书馆微信后台管理系统</title>
		<link rel="stylesheet" type="text/css" href="../style/micropage.css">
	</head>
	<body>
		欢迎登入湖南理工学院图书馆微信后台管理系统！<br /><br />
		<?php
			echo "系统当前状态：<br />";
			echo "新增关注用户：";
			$file_arr=read_config_file("../config/config.dat");
			$lastloadtime==null;
			foreach ($file_arr as $key => $value) {
				$value = preg_replace('/[\s　]/', '', $value);
				if ($value == "#lastloadtime") {
					$lastloadtime=$file_arr[$key+1];
				} 
			}
			if ($lastloadtime == null) {
				echo 'read config file error!';
			}else{
				$sql="select open_id from lib_user where sub_time>'".$lastloadtime."' and sub_time < '".date('Y-m-d H-i-s',time())."'";
				$ans_arr = $dbObj->get_all($sql);
				if ($ans_arr){
					echo count($ans_arr);
				}else{
					echo '0';
				}
			}
			$ans_arr = null;
			echo "<br />当前绑定用户：";
			$sql = "select open_id from lib_user where status = '1'";
			$ans_arr = $dbObj->get_all($sql);
			if ($ans_arr) {
				echo count($ans_arr);
			}else{
				echo '0';
			}
			$ans_arr = null;
			echo "<br />未解决问题：";
			$sql = "select serial from libQuestion where isSolve = '0'";
			$ans_arr = $dbObj->get_all($sql);
			if ($ans_arr) {
				echo count($ans_arr)."个<a href='./lib_qr.php' target='rightContext'>(点击此处查看)</a>";
			}else{
				echo '暂时没有待解决的问题！';
			}
			$ans_arr = null;
			//新增关注人数:时间间隔取此处load页面的时间减去8个小时（格林时间）此时的时间段内增加的关注人数
			date_default_timezone_set('Etc/GMT');//大量并发关注人数可设置为北京时间，时间间隔取每次load页面之间的时间段
			write_config_file( "../config/config.dat" , array( 0=>'#lastloadtime' , 1=>date("Y-m-d H:i:s" , time()) ) );
			date_default_timezone_set('PRC');//
		?>
		<hr />
		快捷管理：<a href="javascript:;" onclick="window.location.href='./modle/modify.php?type=cmd&serial=1&key=?'"><input type="button" value="主菜单"></a>
	</body>
</html>