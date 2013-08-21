<?php
session_start();
//引用用户类
include("user.php");
//初始化用户名
$user = new user();
//调用用户登录信息验证函数
$user->auth();
?>
<!---------------11_3.php------------------->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
 <head>
  <title>用户援权页面</title>
 </head>
 <body>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td height="67" colspan="2"><div align="center">用户登录权限演示</div></td>
  </tr>
  <tr>
    <td width="18%" height="236" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="29"><div align="center">欢迎你：</div></td>
      </tr>
<?PHP
//在单个页面内，为每一个权限点设置访问链接
if($user->checkPoint(intval($_SESSION["auth"]["role"]),1)){
	echo "<tr><td><div align='center'><a href='1.php'>可访问权限页一</a></div></td></tr>";
}
if($user->checkPoint(intval($_SESSION["auth"]["role"]),2)){
	echo "<tr><td><div align='center'><a href='2.php'>可访问权限页二</a></div></td></tr>";
}
if($user->checkPoint(intval($_SESSION["auth"]["role"]),3)){
	echo "<tr><td><div align='center'><a href='3.php'>可访问权限页三</a></div></td></tr>";
}
?>
      <tr>
        <td><div align="center"></div></td>
      </tr>
    </table></td>
    <td width="82%"><div align="center">登录后，主显示页面。</div></td>
  </tr>
</table>
 </body>
</html>
