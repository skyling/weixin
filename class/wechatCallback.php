<?php
/**
 * wechatCallback
 * @author skyling
 *
 */
class wechatCallback {
	private $postStr;		//post字符串
	private $postObj;		//解析post后得到的xml对象	
	private $ToUserName;	//开发者微信号
	private $FromUserName;	// 发送方帐号（一个OpenID）
	private $CreateTime;	//消息创建时间 （整型）
	private $MsgType;		//消息类型
	private $Content;		// 文本消息内容
	private $MsgId;			//消息id，64位整型
	private $event;			//事件
	private $eventkey;		//消息键
	
	
	/**
	 * 构造函数
	 */
	function __construct(){
		$this->postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($this->postStr)){
			$this->postObj = simplexml_load_string($this->postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->ToUserName=$this->postObj->ToUserName;
			$this->FromUserName=$this->postObj->FromUserName;
			$this->MsgType=$this->postObj->MsgType;
			if($this->MsgType == 'text'){
				$this->Content=$this->postObj->Content;
			}
			if($this->MsgType == 'event'){
				$this->event= $this->postObj->Event;
				$this->eventkey = $this->postObj->EventKey;
			}
			$this->MsgId=$this->postObj->MsgId;
		}
		//验证
		if (isset($_GET['echostr'])) {
			$this->valid();
		}
	}

	//验证 token方法
	public function valid()
	{
		$echoStr = $_GET["echostr"];
		if($this->checkSignature()){
			echo $echoStr;
			exit;
		}
	}
	//验证 token方法
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
	
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
	
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	/**
	 * @return $postObj
	 */
	public function getPostObj() {
		return $this->postObj;
	}
	/**
	 * @return $ToUserName
	 */
	public function getToUserName() {
		return $this->ToUserName;
	}

	/**
	 * @return $FromUserName
	 */
	public function getFromUserName() {
		return $this->FromUserName;
	}

	/**
	 * @return $CreateTime
	 */
	public function getCreateTime() {
		return $this->CreateTime;
	}

	/**
	 * @return $MsgType
	 */
	public function getMsgType() {
		return $this->MsgType;
	}

	/**
	 * @return $Content
	 */
	public function getContent() {
		return $this->Content;
	}

	/**
	 * @return $MsgId
	 */
	public function getMsgId() {
		return $this->MsgId;
	}
	/**
	 * @return $event
	 */
	public function getEvent() {
		return $this->event;
	}
	/**
	 * @return $eventkey
	 */
	public function getEventkey() {
		return $this->eventkey;
	}




}

?>