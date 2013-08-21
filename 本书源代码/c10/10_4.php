<?php
/********************10_4.php*******************************/
class socketClient{
	function socketClient($ip,$port,$action){
		//关闭错误信息显示
		ini_set("display_errors",0);
		//关闭脚本失效时间
		set_time_limit(0);
		$this->startClient($ip,$port,$action);
	}
	function startClient($ip,$port,$action){
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);//创建一个SOCKET
		if($socket){
			print "创建客户端成功！<br>";
		}else{
			print "创建客户端失败！<br>";
		}
		//使用socket_connect()连接服务器
		$link = socket_connect($socket,$ip,$port);
		if($link){
			print "连接服务器成功！<br>";
		}else{
			print "连接服务器失败！<br>";
		}
		//读取从服务器取回的内容
		$serverData = socket_read($socket,1024);
		print $serverData."<br>";
		socket_write($socket,$action,strlen($action));
		$msg =trim(socket_read($socket,1024));
		echo "发送：$action ";
		echo "收到：$msg<br>";
		socket_close($socket);
	}
}
if(isset($_GET["action"])){
	$action = strval($_GET["action"]);
}else{
	$action = "help";
}
$client = new socketClient("127.0.0.1",1000,$action);
?>
<form action=10_4.php method=gemt name=sendAction>
	<input type=text name=action value=""><input type=submit name=send value="发送">
</form>