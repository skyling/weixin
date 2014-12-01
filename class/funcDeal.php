<?php
/**
 * 消息处理类
 * @author skyling
 *
 */
class funcDeal {
	private $objMysql;			//mysql数据库类
	private $objoci;			//oracle数据库类
	private $objWechat;			//消息接收类
	private $objUser;			//用户类
	private $objociDeal;		//oracle处理类
	private $objResp;			//消息回复类
	private $cmd;				//获取消息
	private $cmd_type;			//消息类型
	private $flag;				//消息是否为特殊消息    真为是  
	
	function __construct(mydb $objMysql,wechatCallback $objWechat,lib_user $objUser){//lib_response $objResp  ocidb $objoci
		$this->objMysql= $objMysql;
		$this->objWechat= $objWechat;
		$this->objUser= $objUser;
		$this->objoci= new ocidb();
		$this->flag=false;
		
		
		$this->getCmd();	//获得消息
		
		$this->createResp();	//根据消息创建一个消息回复对象
		$this->objociDeal = new lib_ociDeal($this->objUser, $this->objoci,$this->objResp);
		/***************************\
		 特殊消息处理函数
		\***************************/
		$this->subscribe();		//关注状态处理
		$this->bindding();		//需要绑定的消息回复
		/***************************\
		 特殊消息处理函数
		\***************************/
		
		$this->callBack();		//回复消息
		
		
		
		
		
	}
	
	/**
	 * 绑定有关的消息回复
	 */
	private function bindding(){
		
		$pattern = '/^qxbd$/i';
		if (preg_match($pattern, $this->cmd)) {
			$this->objUser->setStatus(0);
			$this->objUser->setName('');
			$this->objUser->updataInfo();
			//$this->objResp->setRes_cmd('qxbd');
		}
		$pattern = '/^\#(.+)\#(.+)$/';
		preg_match($pattern, $this->cmd,$info);
		if (count($info)==3) {
			
			$flag = $this->objociDeal->binding($info[1], $info[2]);
			if($flag){
				$this->objResp->setRes_cmd('bdcg');
			}else $this->objResp->setRes_cmd('bdsb');
		}
		if($this->cmd == 4 ){	//这项是需要绑定的  判断用户是否绑定
			$stat = $this->objUser->getStatus();
			if ($stat == 1) {	//已绑定  为绑定原样输出
				//处理绑定后的结果
				$this->flag = true;
				if($this->cmd == 4){
					$this->objociDeal->getLendInfo();
				}
				$this->objResp->msgLendInfo();//借阅情况处理函数
			}
		}
		if($this->cmd=='sbxj'){
			include_once 'renew.php';
			$stuid = $this->objUser->getStu_id();
			$stat = $this->objUser->getStatus(); 
			if ($stuid !=null && $stat == 1) {
				$rt = renew($stuid,$this->objoci);
			}else{
				 $rt = "您目前还没有进行学号绑定,请回复4进行绑定!";
			}
			
			$this->objResp->setXJ($rt);
		}
	}
	
	
	/**
	 * 根据flag标记是否为特殊处理消息回复消息
	 */
	private function callBack(){
		if(!$this->flag){
			$this->objResp->msgResponse();
		}
	
	}
	/**
	 * 关注和取消关注处理函数
	 */
	private function subscribe(){
	//	if($this->cmd_type == 'event'){

			//事件发生时数据库相关处理
//			$subtime = $this->objUser->getSub_time();
	//		if($subtime == null){
				$this->objUser->sub_stat(true);
//			}
			if($this->cmd == 'subscribe'){	//关注时
				$this->objUser->sub_stat(true);
				$this->objResp->setRes_cmd('?');
			}
			if($this->cmd == 'unsubscribe'){	//取消关注
				$this->objUser->sub_stat(false);
			}
			
	//	}
	}
	
	/**
	 * 得到用户发送的命令
	 */
	private function getCmd(){
		$this->cmd_type = $this->objWechat->getMsgType();
		//根据消息类型获取消息的值
		if($this->cmd_type == 'text'){
			$this->cmd = $this->objWechat->getContent();
		}
		//关注时触发的消息
		if($this->cmd_type == 'event'){
			$this->cmd = $this->objWechat->getEvent();
			if($this->cmd == 'CLICK'){
				$this->cmd = $this->objWechat->getEventkey();
			}
		}
		
		
	}
	
	/**
	 * 更具获得的命令创建一个消息回复类
	 */
	private function createResp(){
		$this->objResp = new lib_response($this->cmd, $this->objMysql, $this->objWechat,$this->objoci);
	}
	
}

?>