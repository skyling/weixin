<?php
/**
 *消息处理回复类
 * 
 */
include_once 'connections/mydb.php';
include_once 'news.class.php';
class lib_response {
	private $res_objSql;	//数据库对象
	private $res_cmd;		//指令
	private $res_response;	//回复用户的xml
	private $res_objWechat;	//微信消息对象
	private $time;			//当前时间
	private $objoci;		//oracle对象
	private $lendinfo;		//借阅信息
	private $xj;			//续借
	
	/**
	 * 构造函数
	 * @param unknown $cmd  命令
	 * @param unknown $mydb  数据库对象
	 * @param unknown $wechat wechat 对象
	 */
	function __construct($cmd,mydb $mydb,wechatCallback $wechat,$ocibj){
		$this->res_cmd = $cmd;
		$this->res_objSql = $mydb;
		$this->res_objWechat = $wechat;
		$this->objoci=$ocibj;
		//$this->res_objSql = new mydb();//-------
		//$this->res_objWechat= new wechatCallback();//-------
		$this->time = time();
	//	$this->msgResponse();
	}
	/**
	 * 消息头部和尾部组装
	 * @param  string $flag  head返回头  end返回尾
	 * @param  string $type  消息类型
	 * @param  int $num    图文消息时的条数
	 * @return string  返回相应xml数据
	 */
	private function xml_headEnd($flag,$type='text',$num=0){
		if($flag=='head'){
			$head_text="<xml>
					<ToUserName><![CDATA[{$this->res_objWechat->getFromUserName()}]]></ToUserName>
					<FromUserName><![CDATA[{$this->res_objWechat->getToUserName()}]]></FromUserName>
					<CreateTime>{$this->time}</CreateTime>
					<MsgType><![CDATA[{$type}]]></MsgType>";
			if($type=="news"){
				if ($this->lendinfo!=null) {			//借阅信息条数
					if (count($this->lendinfo[0])>9) {
						$num=8;
					}else{
						$num = count($this->lendinfo[0])+1;
					}
				}
                if($this->res_cmd==6)
                $num=7;
				$head_text .= "<ArticleCount>{$num}</ArticleCount>";
			}
			return $head_text;
			
		}
		if ($flag=='end') {
			return "</xml>";
		}
	}
	/**
	 * xml消息主体处理函数
	 * @param string $type  消息类型
	 * @param string $args  消息参数
	 * @return string		对应的xml返回
	 */
	private function xml_body($type,$args){
		$body_text='';
		switch($type){
			case 'text':		//消息为文本
				$text = $args[0][2];
				$text = $this->binding($text);
				$body_text="<Content><![CDATA[$text]]></Content>";
				break;
			case 'news':		//消息为图文
				$body_text="<Articles>"; 
				$tmp="<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
					</item>";
				if ($this->lendinfo == null) {	//非个人 借阅信息回复
					if($this->res_cmd==6)
					{   
						$body_text.= sprintf($tmp,$args[0][3],$args[0][4],$args[0][5],$args[0][6]);
 						$openid=$this->res_objWechat->getFromUserName();
						$sql="select stu_id from lib_user where open_id='{$openid}'";
						$ret=$this->res_objSql->get_one($sql);
						$stu_id=$ret[0];//学号
						$flag=0;
						$stat=0;
						$stu_id=substr($stu_id,0,strlen($stu_id)-4);
						do{
							if($stat!=0){
								$stu_id='';
							}
							$sql="select cert_id from reader where cert_id like '{$stu_id}%' ";
							$friends=$this->objoci->get_all($sql);
							$num_friend=count($friends);//朋友总数
							 
							$num_id=array();
							for($i=0;$i<$num_friend;$i++)
							{
							
								$j=rand(0, $num_friend);
								for($k=0;$k<count($num_id);$k++)
								{
										if($j==$num_id[$k])
										{
										$j=rand(0, $num_friend);
										$k=0;
							
										}
										 
								}
							$num_id[]=$j;
							$sql = "select name from reader where cert_id='{$friends[$j][0]}' ";
							$name=$this->objoci->get_one($sql);
							$name=$name[0];
							$name=substr($name,0,strlen($name)-3)."*";
							$sql="select marc_rec_no_f from lend_hist where cert_id_f='{$friends[$j][0]}' order by lend_date desc ";
							$ret=$this->objoci->get_one($sql);
							if($ret[0]!=null)
							{
								$flag++;
								$sql="select m_title from marc where marc_rec_no='{$ret[0]}'";
								$book_name=$this->objoci->get_one($sql);
								$body_text.= sprintf($tmp,$name."__《".$book_name[0]."》",'','','');
							}
							if($flag==7){
								break;
							}
							}
							$stat=1;
						}while($flag == 0); 
					}
					else 
					{							
						for($i=0;$i<count($args);$i++){
							if($this->res_cmd == '?' && $i==2){
								$args[$i][6] = $args[$i][6].'?openid='.$this->res_objWechat->getFromUserName();
							}
							$body_text .= sprintf($tmp,$args[$i][3],$args[$i][4],$args[$i][5],$args[$i][6]);
						}	
					}


				}else{			//个人 借阅信息回复
					$url = $args[0][6].'?openid='.$this->res_objWechat->getFromUserName();
					$body_text .= sprintf($tmp,$this->lendinfo[0][0],'',$args[0][5],$url);
					for($i=0;$i<count($this->lendinfo[1]);$i++){
						if($this->lendinfo[1][$i]==4){
							$pic = $args[1][5];
							$url='';
						}else {
							$pic = $args[2][5];
							$url = $args[2][6];//.'?openid='.$this->res_objWechat->getFromUserName().'&token='.$this->lendinfo[2][$i];
						}
						//书本单
						$body_text .= sprintf($tmp,$this->lendinfo[0][$i+1],'',$pic,$url);
					}
					$url = $args[3][6].'?openid='.$this->res_objWechat->getFromUserName();
					$body_text .= sprintf($tmp,$args[3][3],$args[3][4],$args[3][5],$url);
				}
				
				$body_text .= "</Articles>";
				break;
			default:break;
		}
		return $body_text;
	}
	/**
	 * 借阅情况,从学校服务器获取数据
	 */
	public function msgLendInfo(){
		
		if($this->res_cmd == 4){
			$this->res_cmd = 'jyxx';
		}
		if($this->res_cmd == 3){
			$this->res_cmd = 'szzy';
		}
		
		$this->msgResponse();
	}
	 /**
	  * 读取数据库  回复消息
	  * @param unknown $cmd  消息处理命令
	  */
	public function msgResponse(){
		$cmd = $this->res_cmd;
		$result="";
		$sql="select * from lib_cmd where cmd_key='{$this->res_cmd}'";
		$ret = $this->res_objSql->get_one($sql);
		if($ret == null){
			$this->res_cmd = '?';
			$sql="select * from lib_cmd where cmd_key='{$this->res_cmd}'";
			$ret = $this->res_objSql->get_one($sql);
		}
		if($ret!=null){
			$sql="select * from lib_content where con_cmd='{$ret[1]}'";
			$ret_content=$this->res_objSql->get_all($sql);
			if($ret_content!=null){
				$num = count($ret_content);
				$type = $ret[2];
				$args = $ret_content;
				$head = $this->xml_headEnd('head', $type,$num);	//得到对应的xml头
				$body = $this->xml_body($type, $args);		//得到body主体
				$end = $this->xml_headEnd('end');
				$result=$head.$body.$end;
 			}
		}
		echo $result;
	}
	
	public function setLendInfo($name,$lend_count,$lend_info){
		$title[0]="尊敬的【{$name}】,您当前借阅图书【{$lend_count[0]}】本,【{$lend_count[1]}】本超期,【{$lend_count[2]}】本即将超期";
		for($i=0;$i<$lend_count[0];$i++){
			$title[$i+1]=$lend_info[0][$i].'
					应还日期:'.trim($lend_info[2][$i]);
		}
		$this->lendinfo[0]=$title;				//标题及人名
		$this->lendinfo[1]=$lend_info[1];		//书本状态
		$this->lendinfo[2]=$lend_info[3];		//借书编号
	}
	/**
	 * 绑定消息回复  带openid的值
	 */
	public function binding($text){
		if($this->res_cmd == 3 || $this->res_cmd == 4 || $this->res_cmd == 2 ||$this->res_cmd == 'szzy'){
			$pattern = '/(\.php)/';
			$tmp = preg_replace($pattern, '$1'.'?openid='.$this->res_objWechat->getFromUserName(), $text);
			return $tmp; 
		}
		if($this->res_cmd=='新闻'||$this->res_cmd=='xw'||$this->res_cmd=='XW')
		{
			$NEW=new NEWS();
			$text="新闻公告".$NEW->make_news();
		}
		if ($this->res_cmd == 'sbxj') {
			$text = $text."\n".$this->xj;
		}
		return $text;
	}
	
	
	public function setXJ($xj){
		$this->xj = $xj;
	}
	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setRes_cmd($res_cmd) {
		$this->res_cmd = $res_cmd;
	}


}

?>