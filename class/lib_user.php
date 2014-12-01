<?php
/**
 * 用户类
 * @author Prince_Kin
 */
class lib_user{
	private $serial;  					/*编号*/
	private $open_id;					/*微信公众ID*/
	private $status; 					/*是否绑定*/
	private $stu_id;					/*学号*/
	private $sub_status;				/*是否关注*/
	private $sqlObj;					/*数据库连接对象*/
	private $table;						/*处理的数据库表*/
	private $sub_time;					/*关注时间*/
	private $name;						/*名字*/

	/**
	 * 构造函数
	 * @param unknown $userID  用户的openid
	 * @param unknown $sqlObj  数据库对象
	 */
	public function __construct($userID,mydb $sqlObj){
    	$this->open_id = $userID;
    	$this->sqlObj = $sqlObj;
    	$this->table = "lib_user";
    	$this->readInfo();
    }
  	
    /**
     * 关注状态
     */
    public function sub_stat($flag){
    	date_default_timezone_set('PRC');
    	$this->sub_time = date("Y-m-d H:i:s",time());
    	if($flag){
    		$this->sub_status = '1';
	    	if($this->serial==""){		//首次关注
	    		$this->insertInfo();
	    	}else{	//再次关注
	    		$this->updataInfo();
	    	}
    	}else{
    		$this->sub_status = '0';
    		$this->updataInfo();
    	}
    	  	
    }

    /**
     * 更新用户数据
     */
	public function updataInfo()
	{	
		$dataArray = array(
				"status" => $this->status ,
				"stu_id" => $this->stu_id ,
				"sub_status" => $this->sub_status,
				"sub_time" => $this->sub_time,
				"sname" => $this->name
		);
		$condition = "open_id = '$this->open_id'";
		return $this->sqlObj->update($this->table, $dataArray,$condition);
		
	}
	/**
	 * 从数据库得到数据
	 * @param unknown $link  数据库连接
	 * @return boolean
	 */
	public function readInfo(){
		$sql = "select * from lib_user where open_id ='{$this->open_id}'";
		$result = $this->sqlObj->get_one($sql);
		if ($result!=null) {
			$this->serial = $result['serial'];
			$this->status = $result['status'];
			$this->stu_id = $result['stu_id'];
			$this->sub_status = $result['sub_status'];
			$this->sub_time = $result['sub_time'];
			$this->name = $result['sname'];
		}
	}
	/**
	 * @return $sub_time
	 */
	public function getSub_time() {
		return $this->sub_time;
	}

	/**
	 * 获取全部个人资料信息
	 * @return multitype:NULL 数组
	 */
	public function getInfo(){
		
	}
	/**
	 * 往数据库中插入信息
	 * @return resource  bool类型
	 */
	public function insertInfo(){
		$dataArray = array(
				"open_id" => $this->open_id,
				"status" => $this->status ,
				"stu_id" => $this->stu_id ,
				"sub_status" => $this->sub_status,
				"sub_time" =>$this->sub_time,
				"sname" => $this->name
		);
		return $this->sqlObj->insert($this->table, $dataArray);
	}
	
	/**
	 * 获取个人微信资料
	 * @return array |string
	 */
	public function getWeChatInfo(){
		//https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN
		//接口
		/*
		 * $url="http://api.map.baidu.com/telematics/v3/weather?location={$keyword}&ak=4b7f208e10a3631d5291ebb184055412";
            $rc = file_get_contents($url);    //获得借口返回值
            $rs = simplexml_load_string($rc);
		 * */
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=popye&openid=$this->userID&lang=zh_CN";
		$rc = file_get_contents($url);
		if($rc){
			echo "rc".$rc;
			
			$rs =json_decode($rc);
			echo "rs".$rs;
			$subscribe = $rs->subscribe;	//用户是否订阅该公众号标识，值为0时，代表此用户没有关注该公众号，拉取不到其余信息。
			$openid = $rs->openid;	//用户的标识，对当前公众号唯一
			$nickname = $rs->nickname;	//用户的昵称
			$sex = $rs->sex;	//用户的性别，值为1时是男性，值为2时是女性，值为0时是未知
			$city = $rs->city;	//用户所在城市
			$country = $rs->country;	//用户所在国家
			$province = $rs->province;	//用户所在省份
			$language = $rs->language;	//用户的语言，简体中文为zh_CN
			$headimgurl = $rs->headimgurl;	//用户头像，最后一个数值代表正方形头像大小（有0、46、64、96、132数值可选，0代表640*640正方形头像），用户没有头像时该项为空
			$subscribe_time = $rs->subscribe_time;	//用户关注时间，为时间戳。如果用户曾多次关注，则取最后关注时间
			$arr = array($subscribe,$openid,$nickname,$sex,$city,$country,$province,$language,$headimgurl,$subscribe_time);
			print_r($arr);
		}
		else
		{
			return "获取用户信息失败";
		}
		
	}
	
	
	/**
	 * @return $status
	 */
	public function getStatus() {
		return $this->status;
	}
	
	/**
	 * @return $stu_id
	 */
	public function getStu_id() {
		return $this->stu_id;
	}
	
	/**
	 * @return $sub_status
	 */
	public function getSub_status() {
		return $this->sub_status;
	}
	
	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setStatus($status) {
		$this->status = $status;
	}
	
	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setStu_id($stu_id) {
		$this->stu_id = $stu_id;
	}
	
	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setSub_status($sub_status) {
		$this->sub_status = $sub_status;
	}
	/**
	 * @return $name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setName($name) {
		$this->name = $name;
	}
	

}

?>