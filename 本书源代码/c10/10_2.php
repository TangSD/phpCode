<?php
/********************10_2.php*******************************/
//创建一个SOCKET名柄
$sock = @socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
if($sock != true){
	echo "创建SOCKET时，发生以下错误：".socket_strerror(socket_last_error($sock)). "<br>";
}
//使用socket_bind()绑定IP地址和端口
if(@socket_bind($sock,"127.0.0.1","6000")===false){
	echo "绑定SOCKET时，发生以下错误：".socket_strerror(socket_last_error($sock)). "<br>";
}
if (($newsock = @socket_accept($sock)) === false) {
	echo "获取客户信息失败，错误代码: " .socket_last_error($sock). "<br>";
}
//临听SOCKET
if (@socket_listen($sock, 5) === false) {
    echo "临听失败，错误原因：".socket_strerror(socket_last_error($sock))."<br>";
}
//关闭socket_accept()返回的句柄
@socket_close($newSock);
//关闭socket_create()创建的句柄
@socket_close($sock);
?>
