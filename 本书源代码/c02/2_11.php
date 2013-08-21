<!-------------------------------------------文件名： 2_11.php-------------------------------->
<?php
//定义变量
$var_1 = "变量1";
$var_2 = "user";
$var_3 = "play";
//包含一个文件
include("2_1.php");
//定义一个函数
function show_a(){
	$var_inner = "函数定义的变量";
	echo "访问外部变量：".$var_1."<br>";
	echo "访问内部变量：".$var_inner."<br>";
}
//在函数中使用变量
function show_b(){
	global $var_2;
	echo "访问全局变量：".$var_2.$GLOBALS["var_3"]."<br>";
}
//预定义变量
function show_c(){
	echo "访问全局预定义变量：".$_ENV["OS"]."<br>";
}
//静态变量演示
function show_d()
{
    static $a = 0;
    echo "静态变量演示：".$a."<br>";
    $a++;
}
//运行演示函数
show_a();
show_b();
show_c();
show_d();
show_d();
?>
