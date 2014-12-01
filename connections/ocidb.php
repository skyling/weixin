<?php
class ocidb{
	
	private $link_id;
	private $handle;
	private $is_log;
	private $time;
	private $query;
	
	//构造函数
	public function __construct(){
		$this->time = $this->microtime_float();	//获取时间
		require_once("config.ocidb.php");
		$this->connect($oci_config['username'], $oci_config['password'],$oci_config['db'],$oci_config['charset']);
		$this->is_log = $db_config["log"];
		if($this->is_log){
			$handle = fopen($db_config["logfilepath"]."ocidblog.txt", "a+");
			$this->handle=$handle;
		}
	}
	//数据库连接
	function connect($dbuser,$dbpwd,$dbname = '',$charset='utf-8')
	{
		if(!$this->link_id = oci_connect($dbuser, $dbpwd,$dbname ,$charset)){
			exit('数据库错误!');
		}else {
			$this->query = oci_parse($this->link_id, "");
		}
	}
	
	//查询
	public function query($sql) {
		$this->write_log("查询 ".$sql);
		$this->query = oci_parse($this->link_id, $sql);
		oci_execute($this->query);
		if(!$this->query) $this->halt('Query Error: ' . $sql);
		return $this->query;
	}
	
	//获取一条记录（OCI_ASSOC，OCI_NUM，OCI_BOTH）
	public function get_one($sql,$result_type = OCI_BOTH) {
		$this->query = $this->query($sql);
		$rt =oci_fetch_array($this->query,$result_type);
		$this->write_log("获取一条记录 ".$sql);
		return $rt;
	}
	
	//获取全部记录
	public function get_all($sql,$result_type = OCI_NUM) {
		$this->query = $this->query($sql);
		$i = 0;
		$rt = array();
		while(($row = oci_fetch_array($this->query,$result_type))<>null) {
			$rt[$i]=$row;
			$i++;
		}
		$this->write_log("获取全部记录 ".$sql);
		return $rt;
	}
	/*
	//插入
	public function insert($table,$dataArray) {
		$field = "";
		$value = "";
		if( !is_array($dataArray) || count($dataArray)<=0) {
			$this->halt('没有要插入的数据');
			return false;
		}
		while((list($key,$val)=each($dataArray))<> null) {
			$field .="$key,";
			$value .="'$val',";
		}
		$field = substr( $field,0,-1);
		$value = substr( $value,0,-1);
		$sql = "insert into $table($field) values($value)";
		$this->write_log("插入 ".$sql);
		if(!$this->query($sql)) return false;
		return true;
	}
	*/
	//更新
	public function update( $table,$dataArray,$condition="") {
		if( !is_array($dataArray) || count($dataArray)<=0) {
			$this->halt('没有要更新的数据');
			return false;
		}
		$value = "";
		while((list($key,$val) = each($dataArray))<> null)
			$value .= "$key = '$val',";
		$value .= substr( $value,0,-1);
		$sql = "update $table set $value where 1=1 and $condition";
		$this->write_log("更新 ".$sql);
		if(!$this->query($sql)) return false;
		return true;
	}
	/*
	//删除
	public function delete( $table,$condition="") {
		if( empty($condition) ) {
			$this->halt('没有设置删除的条件');
			return false;
		}
		$sql = "delete from $table where 1=1 and $condition";
		$this->write_log("删除 ".$sql);
		if(!$this->query($sql)) return false;
		return true;
	}
	*/
	//返回结果集
	public function fetch_array($query, $result_type = OCI_ASSOC){
		$this->write_log("返回结果集");
		return oci_fetch_array($this->query, $result_type);
	}
	
	//获取记录条数
	public function num_rows($results) {
		if(!is_bool($results)) {
			$num = oci_num_rows($results);
			$this->write_log("获取的记录条数为".$num);
			return $num;
		} else {
			return 0;
		}
	}
	
	//释放结果集
	public function free_result() {
		oci_free_statement($this->query);
		$this->write_log("释放结果集");
	}
	
	
	//关闭数据库连接
	protected function close() {
		$this->write_log("已关闭数据库连接");
		return @oci_close($this->link_id);
	}
	
	//错误提示
	private function halt($msg='') {
		$msg .= "\r\n".oci_error();
		$this->write_log($msg);
		die($msg);
	}
	
	//析构函数
	public function __destruct() {
		$this->free_result();
		$use_time = ($this-> microtime_float())-($this->time);
		$this->write_log("完成整个查询任务,所用时间为".$use_time);
		if($this->is_log){
			fclose($this->handle);
		}
	}
	
	//写入日志文件
	public function write_log($msg=''){
		if($this->is_log){
			$text = date("Y-m-d H:i:s")." ".$msg."\r\n";
			fwrite($this->handle,$text);
		}
	}
	
	//获取毫秒数
	public function microtime_float() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	
	}
	
	
	
	

		
}

?>