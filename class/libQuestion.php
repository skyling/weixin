<?php
/**
 * 一对一服务提问类
 * @author skyling
 *
 */
require_once '../connections/mydb.php';
class libQuestion {
	private $serial;
	private $person;
	private $ptime;
	private $content;
	private $qtype;
	private $isChecked;
	private $isSolve;
	
	private $sqlObj;
	private $table;
	
	function __construct($person){
		$this->isChecked=0;
		$this->isSolve=0;
		$this->person = $person;
		$this->sqlObj = new mydb();
		$this->table = 'libQuestion';
	}
	
	/**
	 * 根据serial获取一个问题的信息
	 * @return boolean
	 */
	public function getInfoOnebySerial(){
		$sql = "select * from libQuestion where serial = {$this->serial}";
		$ques = $this->sqlObj->get_all($sql);
		if (!$ques) {
			return  false;
		}
		$this->person = $ques[1];
		$this->ptime = $ques[2];
		$this->content = $ques[3];
		$this->qtype = $ques[4];
		$this->isChecked = $ques[5];
		$this->isSolve = $ques[6];
		return true;
	}
	/**
	 * 获取所有问题
	 */
	public function getInfoAll(){
		$sql = "select * from libQuestion";
		$ques = $this->sqlObj->get_one($sql);
		if (!$ques) {
			return  false;
		}
		foreach ($ques as $ques_one){
			$this->serial[] = $ques_one[0];
			$this->ptime[] = $ques_one[2];
			$this->content[] = $ques_one[3];
			$this->qtype[] = $ques_one[4];
			$this->isChecked[] = $ques_one[5];
			$this->isSolve[] = $ques_one[6];
		}
		return true;
	}
	/**
	 * 根据提问者获取问题
	 * @return boolean
	 */
	public function getInfobyPerson(){
		$sql = "select * from libQuestion where person = {$this->person}";
		$ques = $this->sqlObj->get_one($sql);
		if (!$ques) {
			return  false;
		}
		foreach ($ques as $ques_one){
			$this->serial[] = $ques_one[0];
			$this->ptime[] = $ques_one[2];
			$this->content[] = $ques_one[3];
			$this->qtype[] = $ques_one[4];
			$this->isChecked[] = $ques_one[5];
			$this->isSolve[] = $ques_one[6];
		}
		return true;
	}
	
	/**
	 * 获取一个问题回复
	 */
	public function getAnserOne($serial){
		$sql = "select * from libAnser where libQid ={$serial}";
		$ans_arr = $this->sqlObj->get_all($sql);
		return $ans_arr;
	}
	/**
	 * 插入内容
	 */
	public function insetInfo(){
		$this->ptime = date("Y-m-d H:i:s",time());
		$dataArray = array(
				'person' => $this->person,
				'ptime' => $this->ptime,
				'content' => $this->content,
				'qtype' => $this->qtype,
				'isChecked' => $this->isChecked,
				'isSolve' => $this->isSolve
		);
		return $this->sqlObj->insert($this->table, $dataArray);
	}
	/**
	 * @return $person
	 */
	public function getPerson() {
		return $this->person;
	}

	/**
	 * @return $ptime
	 */
	public function getPtime() {
		return $this->ptime;
	}

	/**
	 * @return $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @return $qtype
	 */
	public function getQtype() {
		return $this->qtype;
	}

	/**
	 * @return $isChecked
	 */
	public function getIsChecked() {
		return $this->isChecked;
	}

	/**
	 * @return $isSolve
	 */
	public function getIsSolve() {
		return $this->isSolve;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setContent($content) {
		$this->content = htmlspecialchars($content);
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setQtype($qtype) {
		$this->qtype = $qtype;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setIsChecked($isChecked) {
		$this->isChecked = $isChecked;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setIsSolve($isSolve) {
		$this->isSolve = $isSolve;
	}

	
}
?>