<!---------------------------------------文件名： 7_3.php-------------------------------->
<?php
//引用csv类
include_once("csv.php");
//初始化类，并设置需要操作的文件
$csv = new csv("test.csv");
//显示当前文件的内容
echo $csv->showTable();
//重新设置操作参数
$csv->set("student.csv",",");
//取得当前文件的记录数
echo "当前文件共有记录：".$csv->rows()."<br>";
//删除第六行记录
$csv->delete(6);
echo "当前文件共有记录：".$csv->rows()."<br>";
//新增加一行记录
$row = array("小宫",21,"计算机");
$csv->insert($row);
echo "当前文件共有记录：".$csv->rows()."<br>";
//显示新的CSV文件
echo $csv->showTable(false,false);
?>