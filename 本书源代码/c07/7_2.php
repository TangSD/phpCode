<!---------------------------------------文件名： 7_2.php-------------------------------->
<?php
//引用csv类
include_once("csv.php");
//初始化类，并设置需要操作的文件
$csv = new csv("student.csv");
echo $csv->showTable(false,falsex);
//取得当前文件的记录数
echo "当前文件共有记录：".$csv->rows()."<br>";
echo "年龄为20岁的学生<br>";
$csv->select(1,20);
//预览查询结果
echo $csv->preview();
//取得记录ID为4的记录数据
var_dump($csv->getRow(4));
//取得记录ID为0的记录数据，并以数组形式返回
print_r($csv->getRowArray(4));
?>