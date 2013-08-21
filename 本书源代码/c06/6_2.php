<!---------------------------------------文件名： 6_2.php-------------------------------->
<?php
//引用类
include_once("Charset.php");
//初始化类
$charset = new Charset();
//创建一个测试函数
function test(){
	global $charset;
	$text = "中国";
	$unicode = "&#20013;&#22269;";
	echo "把UTF-8编码的字符'".$charset->gb2utf8($text)."'，转化为GB2312编码：'".htmlspecialchars($charset->utf82gb($charset->gb2utf8($text)))."'";
	echo "<br>";
	echo "把UTF-8编码的字符'".$charset->gb2utf8($text)."'，转化为UNICODE编码：'".htmlspecialchars($charset->utf82unicode($charset->gb2utf8($text)))."'";
	echo "<br>";
	echo "把UNICODE编码的字符'".htmlspecialchars($unicode)."'，转化为UTF-8编码：'".$charset->unicode2utf8($unicode)."'";
	echo "<br>";
	echo "把UNICODE编码的字符'".htmlspecialchars($unicode)."'，转化为GB2312编码：'".$charset->unicode2gb($unicode)."'";
}
test();
?>