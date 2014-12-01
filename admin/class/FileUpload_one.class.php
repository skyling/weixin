<?php
	class FileUpload_one{
		private $filepath;     //指定上传文件保存的路径
		private $allowtype=array('gif', 'jpg', 'png', 'jpeg');  //充许上传文件的类型
		private $maxsize=1000000;  //允上传文件的最大长度 1M
		private $israndname=true;  //是否随机重命名， true false不随机，使用原文件名
		private $originName;   //源文件名称
		private $tmpFileName;   //临时文件名
		private $fileType;  //文件类型
		private $fileSize;  //文件大小
		private $newFileName; //新文件名
		private $errorNum=0;  //错误号
		private $errorMess=""; //用来提供错误报告

		function __construct($options=array()){
			foreach($options as $key=>$val){
				$key=strtolower($key);
				//查看用户参数中数组的下标是否和成员属性名相同
				if(!in_array($key,get_class_vars(get_class($this)))){
					continue;
				}

				$this->setOption($key, $val);
			}
		}	
		//用于获取上传后文件的文件名
		function getNewFileName(){
			return $this->newFileName;
		}
		function getErrorMsg() {
			return $this->errorMess;
		}
		//错误
		private function getError(){
			$str="上传文件<font color='red'>{$this->originName}</font>时出错：";

			switch($this->errorNum){
				case 4: 
					$str .= "没有文件被上传"; 
					break;
				case 3: 
					$str .= "文件部分上传"; 
					break;
				case 2: 
					$str .= "上传文件超过了HTML表单中MAX_FILE_SIZE指定值"; 
					break;
				case 1: 
					$str .= "上传文件超过了php.ini 中upload_max_filesize指定值"; 
					break;
				case -1: 
					$str .= "不充许的类型"; 
					break;
				case -2: 
					$str .= "文件过大，上传文件不能超过{$this->maxSize}个字节"; 
					break;
				case -3: 
					$str .= "上传失败"; 
					break;
				case -4: 
					$str .= "建立存放上传文件目录失败，请重新指定上传目录"; 
					break;
				case -5: 
					$str .= "必须指定上传文件的路径"; 
					break;
				default: 
					$str .= "末知错误";
					break;
			}
			return $str.'<br>';
		}
		//用来检查文件上传路径
		private function checkFilePath(){
			if(empty($this->filepath)) {
				$this->setOption('errorNum', -5);
				return false;
			}

			if(!file_exists($this->filepath) || !is_writable($this->filepath)){
				if(!@mkdir($this->filepath, 0755)){
					$this->setOption('errorNum', -4);
					return false;
				}
			}
			return true;
		}
		//用来检查文件上传的大小
		private function checkFileSize() {
			if($this->fileSize > $this->maxsize){
				$this->setOPtion('errorNum', '-2');
				return false;
			}
			else{
				return true;
			}
		}

		//用于检查文件上传类型
		private function checkFileType() {
			if(in_array(strtolower($this->fileType), $this->allowtype)) {
				return true;
			}
			else{
				$this->setOption('errorNum', -1);
				return false;
			}
		}
		//设置上传后的文件名称
		private function setNewFileName(){
			if($this->israndname){
				$this->setOption('newFileName', $this->proRandName());
			} 
			else {
				$this->setOption('newFileName', $this->originName);
			}
		}
		//设置随机文件名称
		private function proRandName(){
			$fileName=date("YmdHis").rand(100,999);
			return $fileName.'.'.$this->fileType;
		}
	
		private function setOption($key, $val){
			$this->$key=$val;
		}
		//用来上传一个文件
		function uploadFile($fileField){
			$return=true;
			//检查文件上传路径
			if(!$this->checkFilePath()){
				$this->errorMess=$this->getError();
				return false;
			}
			$name=$_FILES[$fileField]['name'];
			$tmp_name=$_FILES[$fileField]['tmp_name'];
			$size=$_FILES[$fileField]['size'];
			$error=$_FILES[$fileField]['error'];

			if($this->setFiles($name, $tmp_name, $size, $error)){
				if($this->checkFileSize() && $this->checkFileType()){
					$this->setNewFileName();

					if($this->copyFile()){
						return true;
					}
					else{
						$return=false;
					}
						
				}
				else{
					$return=false;
				}	
			}
			else{
				$return=false;
			}
			
			if(!$return){
				$this->errorMess=$this->getError();
			}
			return $return;
		}
		//拷贝文件
		private function copyFile(){
			if(!$this->errorNum){
				$filepath=rtrim($this->filepath, '/').'/';
				$filepath.=$this->newFileName;

				if(@move_uploaded_file($this->tmpFileName, $filepath))	{
					return true;
				}
				else{
					$this->setOption('errorNum', -3);
					return false;
				}
					
			}
			else{
				return false;
			}
		}
		//设置和$_FILES有关的内容
		private function setFiles($name="", $tmp_name='', $size=0, $error=0){
			$this->setOption('errorNum', $error);
			if($error){
				return false;
			}
			$this->setOption('originName', $name);
			$this->setOption('tmpFileName', $tmp_name);
			$arrStr=explode('.', $name); 
			$this->setOption('fileType', strtolower($arrStr[count($arrStr)-1]));
			$this->setOption('fileSize', $size);	
			return true;
		}
	}
?>