<?php
/*************************8_1.php****************************/
include("xml.php");
//定义二个数组
$student1 = array("name"=>"小郑","age"=>22,"job"=>"计算机");
$student2 = array("name"=>"小林","age"=>23,"job"=>"计算机");
//初始化xml类，并设置字符集为gb2312
$xml = new xml("gb2312");
//向XML文件中插入记录
$xml->insert($student1);
$xml->insert($student2);
//返回XML内容并显示
$x = $xml->getContents();
echo $x;
?>