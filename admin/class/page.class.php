<?php
	class Page {
		private $total; //数据表中总记录数
		private $listRows; //每页显示行数
		private $limit;//查询数据库查找方式
		private $uri;//截取的URL
		private $pageNum; //页数
		private $config=array('header'=>"条记录", "prev"=>"上一页", "next"=>"下一页", "first"=>"首页", "last"=>"尾页");
		private $listNum=4;//链接页列表数目
		
		public function __construct($total, $listRows=10, $pa=""){//总数、默认十行
			$this->total=$total;
			$this->listRows=$listRows;
			$this->uri=$this->getUri($pa);
			$this->page=!empty($_GET["page"]) ? $_GET["page"] : 1;
			$this->pageNum=ceil($this->total/$this->listRows);//计算总共有多少页，进一取整法
			$this->limit=$this->setLimit();//设置limit
		}

		private function setLimit(){//从下页首行开始取取限制的条数
			return "Limit ".($this->page-1)*$this->listRows.", {$this->listRows}";
		}

		private function getUri($pa){
			$url=$_SERVER["REQUEST_URI"].(strpos($_SERVER["REQUEST_URI"], '?')?'':"?").$pa;
			//echo $url;
			//parse_url()解析URL,解析成路径+查询字符串
			$parse=parse_url($url);
			if(isset($parse["query"])){
				parse_str($parse['query'],$params);
				unset($params["page"]);
				$url=$parse['path'].'?'.http_build_query($params);//重新组合
			}
			return $url;
		}

		public function __get($args){//获取类的私有属性，方法于新浪云下需要共有，自身服务器设为私有方法
			if($args=="limit")
				return $this->limit;
			else
				return null;
		}

		private function start(){//计算开始记录所在行数
			if($this->total==0)
				return 0;
			else
				return ($this->page-1)*$this->listRows+1;
		}

		private function end(){
			return min($this->page*$this->listRows,$this->total);
		}

		private function first(){//首页
			$html='';
			if($this->page==1)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=1'>{$this->config["first"]}</a>&nbsp;&nbsp;";
			return $html;
		}

		private function prev(){//上一页
			$html='';
			if($this->page==1)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=".($this->page-1)."'>{$this->config["prev"]}</a>&nbsp;&nbsp;";
			return $html;
		}

		private function pageList(){//页列表
			$linkPage="";
			$inum=floor($this->listNum/2);
			for($i=$inum; $i>=1; $i--){
				$page=$this->page-$i;
				if($page<1)
					continue;
				$linkPage.="&nbsp;<a href='{$this->uri}&page={$page}'>{$page}</a>&nbsp;";
			}
			$linkPage.="&nbsp;{$this->page}&nbsp;";
			for($i=1; $i<=$inum; $i++){
				$page=$this->page+$i;
				if($page<=$this->pageNum)
					$linkPage.="&nbsp;<a href='{$this->uri}&page={$page}'>{$page}</a>&nbsp;";
				else
					break;
			}
			return $linkPage;
		}

		private function next(){//下一页
			$html='';
			if($this->page==$this->pageNum)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=".($this->page+1)."'>{$this->config["next"]}</a>&nbsp;&nbsp;";
			return $html;
		}

		private function last(){//尾页
			$html='';
			if($this->page==$this->pageNum)
				$html.='';
			else
				$html.="<a href='{$this->uri}&page=".($this->pageNum)."'>{$this->config["last"]}</a>&nbsp;&nbsp;";
			return $html;
		}

		private function goPage(){
			return '<input type="text" onkeydown="javascript:if(event.keyCode==13){var page=(this.value>'.$this->pageNum.')?'.$this->pageNum.':this.value;location=\''.$this->uri.'&page=\'+page+\'\'}" value="'.$this->page.'" style="width:25px;text-align:center;">&nbsp;<input type="button" value="GO" style="width:20px;height:21px;text-align:center;font-size:12px;font-weight:bold;padding-left:0;" onclick="javascript:var page=(this.previousSibling.previousSibling.value>'.$this->pageNum.')?'.$this->pageNum.':this.previousSibling.previousSibling.value;location=\''.$this->uri.'&page=\'+page+\'\'">&nbsp;&nbsp;';
		}
		function fpage($display=array(0,1,2,3,4,5,6,7,8)){
			$html[0]="共{$this->total}{$this->config["header"]}&nbsp;&nbsp;";
			$html[1]="本页{$this->start()}-{$this->end()}条&nbsp;&nbsp;";
			$html[2]="{$this->page}/{$this->pageNum}页&nbsp;&nbsp;";
			$html[3]=$this->first();
			$html[4]=$this->prev();
			$html[5]=$this->pageList();
			$html[6]=$this->next();
			$html[7]=$this->last();
			$html[8]=$this->goPage();
			$fpage='';
			foreach($display as $index){
				$fpage.=$html[$index];
			}
			return $fpage;
		}
	}
