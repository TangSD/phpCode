<?php
/*******************12_4.php*********************/
//包含Smarty类
include("smarty/Smarty.class.php");
//实例化Smarty类
$smarty = new Smarty();
//打开Smarty调试开关
$smarty->debugging = true;
//处理模板标签
$smarty->assign("title","Smarty使用示例");
$smarty->assign("detail","<font size=20>被替换的显示内容</font>");
$smarty->assign("footer","<br>底部内容：<font>copyright.版本所有，2008</font>");
//输出模板内容
$smarty->display('demo.tpl');
?>