<?php
class xml{
	//设置默认字符集
	var $_char    = "utf-8";
	var $_charset = "<?xml version=\"1.0\" encoding=\"{char}\" ?>";
	//设置根结点名称
	var $_root    = "root";
	//用于存储XML内容的变量
	var $_xml     = "";
	//初始化字符集变量
	function xml($char="utf-8"){
		$this->_char = $char;
	}
	//插入一条记录
	function insert($line){
		if(is_array($line)){
			$xml = "<items>";
			foreach($line as $k=>$v){
				$xml .= "<".$k.">".$v."</".$k.">";
			}
			$xml .= "</items>";
			$this->_xml .= $xml;
		}
	}
	//设置要标签
	function setRoot($root){
		$this->_root = $root;
	}
	//取得XML内容
	function getContents(){
		//取得字符集设置字符
		$charset = str_replace("{char}",$this->_char,$this->_charset);
		//使用字符集、根结点、XML数据组成完整的XML内容
		$this->_xml = $charset."<".$this->_root.">".$this->_xml."</".$this->_root.">";
		return $this->_xml;
	}
	//解析XML内容
	function parse($xmlFile){
		if(function_exists("simplexml_load_file")){
			$xml = simplexml_load_file($xmlFile);
		}elseif(function_exists("file_get_contents")){
			$xml = file_get_contents($xmlFile);
			$xml = new SimpleXMLElement($xml);
		}elseif(function_exists("fopen")){
			$handle = fopen($xmlFile,"r");
			$xml = "";
			while(!feof($handle)) {
				$xml .= fread($handle, 8192);
			}
			fclose($handle);
			$xml = new SimpleXMLElement($xml);
		}else{
			$xml = false;
		}
		return $xml;
	}
}
?>
