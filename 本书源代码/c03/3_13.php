<!---------------------------------文件名： 3_13.php-------------------------------->
<?php
//当前日期秒数加上下周时间秒数
$nextWeek = time() + (7 * 24 * 60 * 60);
//显示当前日期
echo '现在日期:'. date('Y-m-d') ."<br>";
//显示下周日期
echo '下周日期:'. date('Y-m-d', $nextWeek)."<br>";
//取得1981年1月1日的Unix时间戳
$time1 = mktime(0,0,0,1,1,1981);
//取得当前时间的Unix时间戳
$time2 = mktime();
//格式化时间戳，转换为常用日期格式
$oldtime = date("Y-m-d H:i:s",$time1);
$nowtime = date("Y-m-d H:i:s",$time2);
//显示日期
echo $oldtime."<br>".$nowtime."<br>";
//两个时间相减，得出时间差
echo $nowtime-$oldtime;
?>