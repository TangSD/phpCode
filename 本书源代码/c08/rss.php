<?php
class rss{
	//设置默认字符集
	var $_xml_char    = "utf-8";
	var $_xml_charset = "<?xml version=\"1.0\" encoding=\"{char}\" ?>";
	var $_rss_ver     = "2.0";
	//用于存储RSS内容的变量
	var $_rss     = "";
	var $_item    = "";
	var $_header  = "";
	//初始化字符集变量
	function rss($title="",$link="",$description="",$char=""){
		$this->_xml_char = $char;
		$this->_header = "<title>".$title."</title>" .
				"<link>".$link."</link>" .
				"<descript>".$description."</descript>";
	}
	//插入一条记录
	function addItem($title,$link,$description,$pubDate){
		$this->_item .= "<item>" .
				"<title>".$title."</title>" .
				"<link>".$link."</link>" .
				"<description>".$description."</description>" .
				"<pubDate>".$pubDate."</pubDate>" .
				"</item>";
	}
	//取得RSS内容
	function getRss(){
		//取得字符集设置字符
		$header = str_replace("{char}",$this->_xml_char,$this->_xml_charset);
		//使用字符集、根结点、RSS数据组成完整的RSS内容
		$this->_rss = $header."" .
				"<rss version = '2.0'>" .
				"<channel>" .
				"".$this->_header.
				$this->_item."" .
						"</channel>" .
						"</rss>";
		return $this->_rss;
	}
	//取得RSS内容的文件
	//以文件的形式，取得生成后的RSS文件内容
	function getFile($name){
		$this->BuildFile($name,$this->_rss);
	}
	//用于创建文件的函数
	function BuildFile($getFile,$getContent,$access="w"){
		if(!$handle = fopen ($getFile,$access)){
			echo "ERROR:目录权限配置错误";
			exit();
		}
		if(!fwrite($handle,$getContent)){
			echo "ERROR:文件写入错误";
			exit();
		}
		fclose($handle);
	}
	//获取远程RSS并解析
	function agg($rssChannel,$show = 0){
		$file = fopen ($rssChannel, "r");
		if (!$file) {
		    echo "<p>读取远程文件失败.\n";
		    exit;
		}
		$rss = "";
		while (!feof($file)) {
		    $rss .= fgets($file, 1024);
		}
		fclose($file);
		$deRss = new SimpleXMLElement($rss);
		if($show == 0){
			return $deRss;
		}else{
			print $this->rssTemplate($deRss);
		}
	}
	//用于显示RSS内容的模板函数
	function rssTemplate($rss){
		include("../c06/charset.php");
		$char = new Charset();
		$header = "<tr><td><strong><a href='".$char->utf82gb($rss->channel->link)."'>" .
				"".$char->utf82gb($rss->channel->title)."</strong></a><br>" .
				"".$char->utf82gb($rss->channel->descript)."</td></tr>" .
				"<tr><td height=1 bgcolor=#cfcfcf></td></tr>";
		$body = "";
		foreach($rss->channel->item as $k=>$v){
				$body .= "<tr><td>".$char->utf82gb($v->title)."  ".$char->utf82gb($v->pubDate)."<br><hr>".$char->utf82gb($v->description)."</td></tr>";
		}
		echo "<table border=1>".$header.$body."</table>";
	}
}
?>
