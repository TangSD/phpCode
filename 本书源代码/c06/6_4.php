<!---------------------------------------文件名： 6_4.php-------------------------------->
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
//定义需要解码的数组
//使用charset类中的gb2unicode()函数，编码变量中的gb2312字符
$string = '[{"username":"'.$charset->gb2unicode("中文").'","password":"1","style":"css1"},{"username":"jake","password":"2","style":"css2"}]';
//以对象的形式，返回解码后的JSON数据
$json_data = $json->decode($string,false);
echo "<pre>";
//使用对象方式，访问数据
echo $json_data[0]->username;
print_r($json_data);
//以数组形式，返回解码后的JSON数据
$json_data = $json->decode($string);
//使用数组方式，访问数据
echo $json_data[0]["username"];
//显示返回数据的结构
print_r($json_data);
echo "</pre>";
?>
