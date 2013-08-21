<?php
/*************************8_3.php****************************/
include("rss.php");
//初始化rss类，并设置字符集为gb2312
$rss = new rss("测试频道","http://www.rss.org","测试用ＲＳＳ内容","gb2312");
//向RSS中插入记录
for($i=1;$i<5;$i++){
	$rss->addItem("第".$i."条记录","http://www.rss.org?i=$i","第".$i."条测试记录",date("Y-m-d H:i:s"));
}
//返回XML内容并显示
$r = $rss->getRss();
echo $r;
//取得保存rss内容的文件
$rss->getFile("rss.xml");
?>