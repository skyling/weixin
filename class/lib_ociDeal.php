<?php
/**
 * orcal 数据库处理
 * @author skyling
 *
 */ 
class lib_ociDeal{
	private $objUser;		//用户对象
	private $objOci;		//oracle数据库对象
	private $objResp;		//消息回复对象
	private $lendinfo;
	
	function __construct(lib_user $objUser,ocidb $objOci,$objResp=''){
		$this->objOci = $objOci;
		$this->objUser = $objUser;
		if ($objResp!=null) {
			$this->objResp = $objResp;
		}
		
	}
	
	/**
	 * 用户学号绑定
	 * @param unknown $username
	 * @param unknown $pass
	 */
	public function binding($username,$pass){
			$sql = "select password from reader where cert_id = '".$username."'";
			$ret = $this->objOci->get_one($sql);
			$passwd = md5($pass);
			$pattern = '/'.$ret[0].'/i';
			if(preg_match($pattern, $passwd)){
				$this->objUser->setStu_id($username);
				$this->objUser->setStatus(1);
				$this->objUser->updataInfo();
				return true;
			}
		return false;
	}
	
	public function getLendInfo(){
		$username = $this->objUser->getStu_id();
		$username = strtoupper($username);
		$sql = "select * from lend_lst where cert_id = '{$username}'";
		$ret = $this->objOci->get_all($sql);
		$sql = "select name from reader where cert_id='{$username}'";
		$ret_n = $this->objOci->get_one($sql);
		$name = $ret_n[0];//读者姓名
		if ($this->objUser->getName() == null) {
			$this->objUser->setName($name);
			$this->objUser->updataInfo();		//将名字写入数据库
		}
		
		$book_count = count($ret);//所借书书本数量
		$ex_num = 0;				//超期本数
		$wex_num = 0;				//即将超期
		//$lend_stat
		$time = date("Y-m-d",time());
		
		for($i=0;$i<count($ret);$i++){
			$sql = "select marc_rec_no from item where prop_no='{$ret[$i][1]}'";
			$ret_i = $this->objOci->get_one($sql);
			$sql = "select m_title from marc where marc_rec_no='{$ret_i[0]}'";
			$ret_m = $this->objOci->get_one($sql);
			$book_name[$i]=$ret_m[0];		//书名
			$book_num[$i] = $ret[$i][12];			//借书编号
			$ret_date = $ret[$i][3];		//应还日期
			$retdate[$i] = $ret_date;		//应还日期
			if ($ret[$i][5] == 1) {
				$lend_stat[$i]=2;			//未超期不可续借
			}
			if(strtotime($ret_date)<=strtotime($time)){
				$ex_num++;
				$lend_stat[$i]=4;			//超期
			}else if((strtotime($ret_date)-(strtotime($time))<4*24*60*60)){
				$wex_num++;				
				$lend_stat[$i]=3;		//即将超期
			}else $lend_stat[$i]=1;		//正常
		}
		//$lend_count  [0] 所借书书本数量 [1]超期本数 [2]即将超期
		
		$lend_count[0]=$book_count;
		$lend_count[1]=$ex_num;
		$lend_count[2]=$wex_num;
		//$lend_info [0]书名 [1]4超期的书3即将超期的 1正常的 2续借过的
		$lend_info[0]=$book_name;
		$lend_info[1]=$lend_stat;
		$lend_info[2]=$retdate;
		$lend_info[3]=$book_num;		//所借书编号
		$this->lendinfo[0]=$name;
		$this->lendinfo[1]=$lend_count;
		$this->lendinfo[2]=$lend_info;
		if ($this->objResp!=null) {
			$this->objResp->setLendInfo($name, $lend_count, $lend_info);
		}
		

		
	}
	/**
	 * @return $lendinfo
	 */
	public function _getLendinfo() {
		return $this->lendinfo;
	}

	
	
} 

?>