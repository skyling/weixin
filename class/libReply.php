<?php
/**
 * 一对一服务回复类
 * @author fox-life-one
 *
 */
require_once '../connections/mydb.php';
class libReply {
	private $serial;
	private $person;
	private $libQid;
	private $atime;
	private $content;
	
	private $dbObj;
	private $table;
	
	function __construct(){
		$this->dbObj = new mydb();
		$this->table = "libReply";
	}
	/**
	 * 插入内容
	 */
	public function insertInfo(){
		$this->atime = date("Y-m-d H:i:s",time());
		$dataArray = array(
				'person' => $this->person,
				'libQid' => $this->libQid,
				'atime' => $this->atime,
				'content' => $this->content
		);
		return $this->dbObj->insert($this->table, $dataArray);

	}
	/**
	 * @return $serial
	 */
	public function getSerial() {
		return $this->serial;
	}

	/**
	 * @return $person
	 */
	public function getPerson() {
		return $this->person;
	}

	/**
	 * @return $libQid
	 */
	public function getLibQid() {
		return $this->libQid;
	}

	/**
	 * @return $atime
	 */
	public function getAtime() {
		return $this->atime;
	}

	/**
	 * @return $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setPerson($person) {
		$this->person = $person;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setLibQid($libQid) {
		$this->libQid = $libQid;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setAtime($atime) {
		$this->atime = $atime;
	}

	/**
	 * @param !CodeTemplates.settercomment.paramtagcontent!
	 */
	public function setContent($content) {
		$this->content = htmlspecialchars($content);
	}

}

?>