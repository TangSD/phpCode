<?php
//<!-------------------------------------------文件名： 3_8.php-------------------------------->
//初始化SESSION数据
session_start();
//定义一个SESSION
$svalue = "SESSION数据";
session_register("svalue");
$sid = session_id();
//使用GET方法传递SESSION的ID
echo "<a href='get_session_id.php?sid=".$sid."'>转到下一页</a>";
//模拟COOKIE进行SESSION的ID传递
$fp = fopen("sid.txt","w");
fwrite($fp,$sid);
fclose($fp);
?>
<?php
//<!-------------------------------------------文件名： get_session_id.php-------------------------------->
//使用GET方法取得SID，
$sid = $_GET["sid"];
//读取文件中的SID
$fp = fopen("sid.txt","r");
$sid = fread($fp,8192);
fclose($fp);
//根据SID初始化SESSION数据
session_start($sid);
echo $_SESSION["svalue"];
?>
