<?php
//<!---------------------------------------文件名： 7_7.php-------------------------------->
//引用INI类文件
include_once ("ini.php");
$ini = new ini();
$data = array(
	"第一节"=>array("网站名称"=>"PHP实例","网址"=>"http://www.rzphp.com"),
	"第二节"=>array("用户名"=>"username","密码"=>"password")
);
$ini->create($data);
print "<pre>";
$ini->getContents();
$ini->getFile("test.ini");
print "</pre>";
?>