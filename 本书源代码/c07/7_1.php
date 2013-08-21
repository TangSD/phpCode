<!---------------------------------------文件名： 7_1.php-------------------------------->
<?php
//引用csv类
include_once("csv.php");
//初始化类，并设置需要操作的文件
$csv = new csv("student.csv");
//定义二维数组
$student = array(
	array("小李",19,"计算机"),
	array("小张",18,"计算机"),
	array("小刘",19,"计算机"),
	array("小苑",20,"计算机"),
	array("小吴",20,"计算机"),
	array("小王",20,"计算机"),
	array("小朱",18,"计算机")
);
//根据二维数组创建CSV文件
$csv->create($student);
//显示CSV文件内容
echo $csv->showTable(false,false);
?>