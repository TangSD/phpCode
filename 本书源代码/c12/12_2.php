<?php
/**************************12_2.php*******************************/
include("cache.php");
//设置生成的缓存文件保存到html目录下，名称为demo.html，失效时间为30秒
$cache = new cache("html/demo.html",30);
$cache->startCache();
?>
<!-------------缓存输出内容开始--------------->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>缓存演示</title>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
</head>
<body>
<?php
for($i=0;$i<10;$i++){
	echo "这是第".$i."次输出！<br>";
}
?>
</body>
</html>
<!-------------缓存输出内容结束--------------->
<?php
$cache->endCache();
?>
