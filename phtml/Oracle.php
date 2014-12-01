<?php

/** 
 * @author lichao
 * 
 */
class Oracle {
	// TODO - Insert your code here
	var $host="211.69.226.10";
	var $port="1521";
	var $sid="orcl";
	var $user="libsys";
	var $pwd="tianlan8";
	var $font="UTF8";
	var $conn;
	/**
	 */
	function __construct() 
	{
		// TODO - Insert your code here
		$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST =$this->host)(PORT = $this->port)))(CONNECT_DATA=(SID=$this->sid)))";
		$conn =@oci_connect("$this->user", "$this->pwd",$db,"$this->font");
		if(!$conn)
		{
	        $e = oci_error();   // For oci_connect errors pass no handle
	        echo htmlentities($e['message']);
		}else
		{
			$this->conn=$conn;
		}
	}
	
	/**
	 */
	function __destruct() 
	{
		
		// TODO - Insert your code here
	}
	
   /*
    * oracle查询操作oci_fetch_array
    */

   public function oci_check_array($sql)
   {
	   	$results=array();
	   	$stid=oci_parse($this->conn,$sql);// 配置 Oracle 语句预备执行
	   	oci_execute($stid);//执行一条sql语句
	   	while (($row = oci_fetch_array($stid, OCI_BOTH))) 
	   	{	  
	   		  $results[]=$row;//把拿到的数据放到一个数组里,关联型和序列型
	   		 
	    }
	    oci_free_statement($stid);//释放资源
	    return $results;
   
   }
   
   /*
    *  oracle查询操作oci_fetch_all — 获取结果数据的所有行到一个数组
    */
   public function oci_check_all($sql)
   {    
   	    $results=array();
   	    $stid=oci_parse($this->conn,$sql);// 配置 Oracle 语句预备执行
	   	oci_execute($stid);//执行一条sql语句
	   	$row_nums=oci_fetch_all($stid, $results);//返回获取的行数
	   	oci_free_statement($stid);//释放资源
	   	return  $results;	
   }
   /*
    * 操作oracle数据
    */
   public  function query($sql)
   {
	   	$stid=oci_parse($this->conn,$sql);// 配置 Oracle 语句预备执行
	   	oci_execute($stid);//执行一条sql语句
   }
     
   /* 
    * 关闭连接释放资源
    */
   public  function close_connect()
   {
   	  oci_close($this->conn);//关闭连接
   	  sleep(10);
   	  // When $stid is freed, the database connection is physically closed
   }



}

?>