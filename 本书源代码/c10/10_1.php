<?php
/********************10_1.php*******************************/
//创建一个SOCKET名柄
$sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
//使用socket_bind()绑定IP地址和端口
socket_bind($sock,"127.0.0.1","6000");
//临听SOCKET
socket_listen($sock,5);
//接收客户端发送来的连接请求
$newSock = socket_accept($sock);
//接收客户端发送的请求数据
$data = socket_read($newSock,2048,PHP_NORMAL_READ);
//向客户端发送数据
$info = "from Server information!";
socket_write($newSock,$info,strlen($info));
//关闭socket_accept()返回的句柄
socket_close($newSock);
//关闭socket_create()创建的句柄
socket_close($sock);
?>
