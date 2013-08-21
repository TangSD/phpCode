<?php
//<!---------------------------------------文件名： 7_8.php-------------------------------->
//引用INI类文件
include_once ("ini.php");
$ini = new ini();
print "<pre>";
$ini->parse("test.ini");
print_r($ini->getIni());
$ini->parse("test.ini",true);
print_r($ini->getIni());
print "</pre>";
?>