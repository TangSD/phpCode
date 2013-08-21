<?php
class template{
	var $_debug = "";
	var $_themes = "";
	function template($debug=false){
		$this->_debug = $debug;
	}
	function load($file){
		$this->_themes = $this->getContents($file);
		$this->debug("加载模板文件");
	}
	function setLabel($label,$data){
		$this->_themes = str_replace($label,$data,$this->_themes);
		$this->debug("替换模板标签：".$label."为：".$data);
	}
	function out(){
		print $this->_themes;
		$this->debug("输出模板");
	}
	function getContents($file){
		$content = "";
		if(file_exists($file)){
			if(function_exists("file_get_contents")){
				$content = file_get_contents($file);
			}else{
				$fp = fopen($file,"r");
				while(!feof($fp)){
					$content .= fread($fp,1024);
				}
				fclose($fp);
			}
		}else{
			$this->debug("打开模板文件失败");
		}
		return $content;
	}
	function debug($error){
		if($this->_debug == true){
			print $error."<br>";
		}
	}
}
?>
