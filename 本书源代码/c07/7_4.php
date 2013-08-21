<?php
//<!---------------------------------------文件名： 7_4.php-------------------------------->
//引用Excel类文件
include_once("excel.php");
//初始化类，并设置需要操作的Excel文件名
$excel = new excel("test.xls");
//设置Excel文件数据的表头
$title = "姓名,年龄,专业";
//设置Excel文件的数据
$student = array(
	array("小李",19,"计算机"),
	array("小张",18,"计算机"),
	array("小刘",19,"计算机"),
	array("小苑",20,"计算机"),
	array("小吴",20,"计算机"),
	array("小王",20,"计算机"),
	array("小朱",18,"计算机")
);
//使用excel类的create()函数，创建Excel文件
$excel->create($student,$title);
?>