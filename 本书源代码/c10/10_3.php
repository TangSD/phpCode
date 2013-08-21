<?php
/********************10_3.php*******************************/
class socketServer{
	//使用构造函数，初始化相关设置
	function socketServer($ip,$port){
		//关闭错误信息显示
		ini_set("display_errors",0);
		//关闭脚本失效时间
		set_time_limit(0);
		//开启缓冲
		ob_implicit_flush();
		//调用startServer()，开始SOCKET创建
		$this->startServer($ip,$port);
	}
	function startServer($ip,$port){
		$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
		if($socket === true){
			print "服务器创建成功！<br>";
		}else{
			print "服务器创建失败<br>";
		}
		$bind = socket_bind($socket,$ip,$port);
		if($bind === true){
			print "绑定IP地址和端口成功!<br>";
		}else{
			print "绑定绑定IP地址和端口失败<br>";
		}
		$listen = socket_listen($socket);
		if($listen === true){
			print "监听成功！<br>";
		}else{
			print "监听失败!<br>";
		}
		while(true){
			//应答客户端连接请求
			$client = socket_accept($socket);
			if($client===false){
				print "应答客户端连接请求失败<br>";
				break;
			}
			//显示欢迎词
			$welcome = "欢迎登录测试服务器<br>";
			//输出字符到socket
			socket_write($client,$welcome,strlen($welcome));
			//循环读取客户端数据，并根据客户提交的数据，返回内容
			while(true){
				$client = socket_accept($socket);//接受一个SOCKET请求
				if($client){
					echo   "正在临听...";
				}else{
					echo   "客户连接失败！\n";
					break;
				}
          		$welcome = "欢迎登录测试服务器!\n";
          		socket_write($client,$welcome,strlen($welcome));
          		while(true){
          			$cmd = strtolower(trim(socket_read($client,1024)));
          			if(!$cmd){
          				 break;
          			}
					switch($cmd){
						case "web":
                        	$out = $this->web();
                        break;
                        case "help":
                        	$out = $this->help();
                        break;
                        case "quit":
                        	$out = $this->quit();
                        break;
                        default:
                            $out = "无效命令!<br>";
					}
					socket_write($client,$out,strlen($out));
					if($cmd == "quit"){
                  		break;
					}
				}
          		socket_close($client);
			if($cmd == "quit")
                  break;
			}
		}
		socket_close($socket);
	}
	function web(){
		$html = "网络信息服务内容";
		return $html;
	}
	function help(){
		return "帮助信息!";
	}
	function quit(){
		return "退出系统！";
	}
}
$socket = new socketServer("127.0.0.1",1000);
?>
