<?php
/**
*<!-------------------------------------------文件名： 2_9.php-------------------------------->
*  */
session_start();
//设置变量
$s1 = "这是字符串";
$s2 = 12;
$s3 = 12.3;
$s4 = "false";
//使用session_register()函数，注册SESSION变量
session_register("s1");
session_register("s2","s3","s4");//同时注册多个SESSION变量
//直接注册SESSION变量
$_SESSION["s5"] = array(1,2,3,4,5);
$_SESSION["s6"] = "error";
$_SESSION["s7"] = "3.1415926";
echo "遍历$"."_SESSION：<br>";
foreach($_SESSION as $key=>$value){
	echo "$key=>$value<br>";
}
//修改SESSION变量
$_SESSION["s7"] = 3.14159;
echo "使用SESSION变量<br>";
if(session_is_registered("s7")){
	echo "Pi的近似值是：".$_SESSION["s7"]."<br>";
}
//删除指定SESSION变量
unset($_SESSION["s4"]);
session_unregister("s6");
$_SESSION["s7"] = NULL;
echo "遍历删除指定数组成员后的$"."_SESSION：<br>";
foreach($_SESSION as $key=>$value){
	echo "$key=>$value<br>";
}
//删除所有SESSION变量
session_unset();
?>
