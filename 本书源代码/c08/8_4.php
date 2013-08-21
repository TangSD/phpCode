<?php
/*************************8_4.php****************************/
include("rss.php");
//初始化rss类，并设置字符集为gb2312
$rss = new rss();
//定义要获取的RSS频道地址
$rssChannel = "http://rss.zol.com.cn/mobile.xml";
//显示未解码的RSS内容
$rssContent = $rss->agg($rssChannel);
//使用模板显示RSS内容
$rssContent = $rss->agg($rssChannel,1);
?>