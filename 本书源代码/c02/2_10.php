<?php
/**
*<!-------------------------------------------文件名： 2_10.php-------------------------------->
*  */
session_start();
$school = "大学";
session_register("school");
echo $_SESSION["school"]; //输出 大学
echo "<br>";
////使用$GLOBALS显示当前操作系统版本
echo $GLOBALS["_ENV"]["OS"];
//使用$GLOBALS访问SESSION值
echo "<br>";
echo $GLOBALS["_SESSION"]["school"]; //输出大学
?>
