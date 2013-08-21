<!---------------------------------------文件名： 6_1.php-------------------------------->
<?php
//引用类
include_once("Charset.php");
//初始化类
$charset = new Charset();
//创建一个测试函数
function test(){
	global $charset;
	$text = "中国";
	echo "把GB2312编码的字符'".$text."'，转化为UNICODE编码：'".htmlspecialchars($charset->gb2unicode($text))."'";
	echo "<br>";
	echo "把GB2312编码的字符'".$text."'，转化为UTF-8编码：'".htmlspecialchars($charset->gb2utf8($text))."'";
}
//运行测试函数
test();
?>