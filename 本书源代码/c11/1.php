<?php
/**********************1.php***************************/
session_start();
//引用用户类
include("user.php");
//初始化用户名
$user = new user();
//调用用户登录信息验证函数
$user->auth();
if($user->checkPoint(intval($_SESSION["auth"]["role"]),1)){
	echo "欢迎查看已援权页面一";
}else{
	echo "你未被查看些援权页页，请与管理员联系";
}
?>
