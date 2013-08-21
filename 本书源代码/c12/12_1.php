<?php
$like = "我喜欢吃苹果！";
ob_start();
echo $like."<br>";
$cache = ob_get_contents();
$length = ob_get_length();
ob_end_flush();
echo "输出缓存中的内容：".$cache;
echo "输出缓存中内容的长度：".$length."<br>";
function callback($buffer) {
	return (str_replace("苹果", "梨", $buffer));
}
ob_start("callback");
echo $like."<br>";
$cache = ob_get_contents();
$length = ob_get_length();
ob_end_flush();
echo "输出缓存中的内容：".$cache;
echo "输出缓存中内容的长度：".$length;
?>