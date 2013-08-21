<?php
class catchBot{
	function catchBot($botFile){
		$isBot = $this->bots();
		if($isBot!= false){
			$url = $_SERVER ['HTTP_REFERER'];
			$time = date("Y-m-d H:i:s");
			$bots = "爬虫".$isBot.",在".$time."访问了本页。跳转页面是：".$url;
			$this->saveBot($botFile,$bots);			
		}
	}
	function bots(){
		$bots = array(
			"Googlebot"=>"googlebot",
			"MSNbot"=>"msnbot",
			"Yahoobot"=>"slurp",
			"Baiduspider"=>"baiduspider",
			"Sohubot"=>"sohu-search",
			"Lycos"=>"lycos",
			"Robozilla"=>"robozilla"
		);
		$useragent = strtolower ( $_SERVER ['HTTP_USER_AGENT'] );
		foreach($bots as $k=>$v){
			if(strpos($useragent,$v) === true){
				return $k;
			}
		}
		return false;
	}
	function saveBot($botFile,$bots){
		$bot = fopen($botFile,"a");
		fwrite($bot,$bots);
		fclose($bot);
	}
}
?>
<?php
//使用捕获爬虫类
$catch = new catchBot("bots.txt");
?>