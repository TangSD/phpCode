<?php
/*********************17_1.php********************/
class spider {
	private $_url = "";
	private $_sites = "";
	function spider($url) {
		$this->_url = $url;
	}
	function start() {
		$content = $this->socketOpen($this->_url);
		$this->_sites["meta"] = $this->getMeta($content);
		$this->_sites["title"] = $this->getTitle($content);
		$this->_sites["detail"] = $this->getDetail($content);
		$this->_sites["links"] = $this->getLinks($content);
	}
	function getMeta($content){
		$file = "metaCache";
		file_put_contents($file,$content);
		$meta = get_meta_tags($file);
		return $meta;
	}
	function getDetail($contents) {
		preg_match('/<body>(.+)<\/body>/s', $contents, $matches);
		$body = $this->StripHTML($matches[1]);
		$body = strip_tags($body);
		return substr($body, 0, 400);
	}
	function getTitle($contents) {
		preg_match('/<title>(.+)<\/title>/s', $contents, $matches);
		return $matches[1];
	}
	function getLinks($content){
		$pat = '/<a(.*?)href="(.*?)"(.*?)>(.*?)<\/a>/i';
		preg_match_all($pat, $content, $m);
		return $m;
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
	function show(){
		echo "<pre>";
		print_r($this->_sites);
		echo "</pre>";
	}
}
//使用WEB爬虫的方法
$spider = new spider("www.163.com");
$spider->start();
$spider->show();
?>
