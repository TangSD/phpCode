<?php
/*********************17_4.php********************/
class searchFile {
	private $_url = "";
	private $_files = "";
	function searchFile($url) {
		$this->_url = $url;
	}
	function start() {
		$content = $this->socketOpen($this->_url);
		$this->_files["links"] = $this->filterHtml($content);
		$this->_files = $this->filterLinks($content);
		$this->_files = $this->filterFile();
	}
	function filterHtml($content){
		$pat = '/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i';
		preg_match_all($pat, $content, $m);
		return $m;
	}
	function filterLinks($content){
		$realLinks = "";
		//获取网页中的链接
		$links = $this->_files["links"][2];
		//遍历数组，清除不规划链接
		foreach($links as $v){
			if($v!="#"){
				$realLinks[] = $v;
			}
		}
		$regExt = "/\ssrc=\"([^\"]*)\"/iUs"; 
		preg_match_all($regExt, $content, $out, PREG_SET_ORDER); 
		foreach($out as $file){
			$realLinks[] =$file[1];
		}
		return $realLinks;
	}
	function filterFile(){
		$files = $this->_files;
		$downlaodfile = "";
		$fileArray = array("jpg","gif","png");
		foreach($files as $name){
			$ext = end(explode(".",$name));
			if(in_array($ext,$fileArray)){
				$downlaodfile[] = $name;
			}
		}
		return $downlaodfile;
	}
	//获取网址内容
	function socketOpen($url) {
		$fp = fsockopen($url, 80, $errno, $errstr, 30);
		if ($fp === false) {
			echo "连接远程服务器失败：$errstr ($errno)<br />\n";
			return false;
		} else {
			$out = "GET / HTTP/1.1\r\n";
			$out .= "Host: " . $url . "\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
			$contents = "";
			while (!feof($fp)) {
				$contents .= fgets($fp, 1024);
			}
			fclose($fp);
			return $contents;
		}
	}
	//去掉HTML中不相关的代码
	function StripHTML($string) {
		$pattern = array (
			"'<script[^>]*?>.*?</script>'si",
			"'<style[^>]*?>.*?</style>'si"
		);
		$replace = array (
			"",
			""
		);
		return preg_replace($pattern, $replace, $string);
	}
	function download($debug = true){
		if($debug==true){
			echo "<pre>";
			print_r($this->_files);
			echo "</pre>";
		}
		foreach($this->_files as $url){
			$name = end(explode("/",$url));
			$file = @ fopen($url,"r"); 
			if (!$file) { 
				echo "文件找不到"; 
			} else { 
				$newfile = "";
				Header("Content-type: application/octet-stream"); 
				Header("Content-Disposition: attachment; filename=" . $name); 
				while (!feof ($file)) { 
					$newfile .= fread($file,50000); 
				}
				fclose ($file);
				file_put_contents($name,$newfile); 
			} 
						
		}
	}
}
//使用WEB爬虫的方法
$searchFile = new searchFile("www.163.com");
$searchFile->start();
$searchFile->download();
?>
