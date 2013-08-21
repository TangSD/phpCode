<!---------------------------------------文件名： 6_3.php-------------------------------->
<?php
//为了使用中JSON编码解码支持GB2312字符
//可以包含charset字符编码转换类，来实现字符之间的转换
include_once("Charset.php");
//包含JSON编码解码类
include_once("json.php");
//初始化字符编码解码类
$charset = new Charset();
//初始化JSON编码解码类
$json = new JSON();
//定义需要编码的数组
$users = array(
	array("username"=>$charset->gb2unicode("中文"),"password"=>"1","style"=>"css1"),
	array("username"=>"jake","password"=>"2","style"=>"css2")
);
//使用JSON类中的encode()函数进行编码
$json_data = $json->encode($users);
echo $json_data;
?>
