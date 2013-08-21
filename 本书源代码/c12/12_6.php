<?php
/*************12_6.php****************************/
//引用Smarty引擎文件
require 'smarty/Smarty.class.php';
//初始化模板引擎
$smarty = new Smarty;
//定义数据存放学生姓名
$student = array("小李","小明","小孙","小赵","小钱","小玲");
//与模板设置对应关系
$smarty->assign("title","判断语句和循环语句演示");
$smarty->assign("student",$student);
//显示模板内容
$smarty->display('ifsection.tpl');
?>
