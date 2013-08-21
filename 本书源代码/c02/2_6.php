<?php
/**
*<!-------------------------------------------文件名： 2_6.php-------------------------------->
*  */
//设置一个COOKIE,其值为空
setcookie("c1");
//设置一个COOKIE,其值为 this is cookie
setcookie("c2","this is cookie");
//设置一个COOKIE,设置其作用时间为1个小时
setcookie("c3","一个小时后失效",time()+3600);
//设置一个COOKIE,使其作用域是全站
setcookie("c4","cookie的path参数",time()+3600,"/");
//设置一个COOKIE,使其只能在html目录下使用
setcookie("c5","cookie的path参数",time()+3600,"/html/");
//设置一个COOKIE,使其只能用于www.rzphp.com
setcookie("c6","cookie的domain参数",time()+3600,"/","www.rzphp.com");
//设置一个COOKIE,使其可以在www.rzphp.com的二级域名网站上都可使用
setcookie("c7","cookie的domain参数",time()+3600,"/",".rzphp.com");
//设置一个COOKIE,使其值只能使用https方式传输
setcookie("c8","cookie的secure参数",time()+3600,"/","",1);
//设置一个COOKIE,使其只能用于HTTP方式
setcookie("c9","cookie的httponly参数",time()+3600,"/","",0,1);
//设置一个COOKIE,允许其他脚本语言访问.
setcookie("c10","cookie的httponly参数",time()+3600,"/","",0,0);
//使用setcookie()函数设置COOKIE
setcookie("cookie1","这是用setcookie()函数设置的COOKIE");
//使用数组方法添加COOKIE
$_COOKIE["cookie3"] = "这是使用数组单元方式添加的COOKIE";
//使用不同方法删除COOKIE
setcookie("cookie1",NULL);//使用setcookie()函数删除COOKIE
$_COOKIE["cookie3"]=NULL;
unset($_COOKIE["c3"]);
//遍历$_COOKIE
foreach($_COOKIE as $key=>$value){
	echo "$key=>$value<br>";
}
?>
