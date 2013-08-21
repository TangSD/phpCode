<?php
/*************12_7.php****************************/
//引用Smarty引擎文件
require 'smarty/Smarty.class.php';
//初始化模板引擎
$smarty = new Smarty;
//开启缓存开关
$smarty->caching = true;
//设置当前页的缓存有效时间
$smarty->cache_lifetime = 3600;
//定义一个回调函数，供register_block()函数使用
function returnDynamic($title, $content, &$smarty) {
	return $content;
}
//使用register_block()函数，设置模板内容区块和回调函数的对应关系
$smarty->register_block('dynamic', 'returnDynamic', false);
//使用is_cached()函数，检查页面是否被缓存
if($smarty->is_cached('cache.tpl')) {
	//清除cache.tpl相关的缓存
	$smarty->clear_cache('cache.tpl');
	$smarty->assign("title","Smarty缓存演示");
}
//显示页面内容
$smarty->display('cache.tpl');
?>
