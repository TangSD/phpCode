<?php
//<!---------------------------------------文件名： 7_5.php-------------------------------->
//引用Excel类文件
include_once("excel.php");
//初始化类，并设置需要操作的Excel文件名
$excel = new excel("test.xls");
//使用excel类的read()函数，读取Excel文件"test"单元的前三行，前三列的内容
$array = $excel->read("test",3,3);
echo "<pre>";
print_r($array);
echo "</pre>";
?>