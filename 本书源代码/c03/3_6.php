<?php
//<!-------------------------------------------文件名： 3_6.php-------------------------------->
//定义一个存储用户信息和用户样式的数组
$users = array(
	array("username"=>"tom","password"=>"1","style"=>"css1"),
	array("username"=>"jake","password"=>"2","style"=>"css2"),
	array("username"=>"seven","password"=>"3","style"=>"css3"),
	array("username"=>"andy","password"=>"4","style"=>"css4"),
	array("username"=>"king","password"=>"5","style"=>"css5"),
	array("username"=>"robert","password"=>"6","style"=>"css6")
);
//定义一个函数,用于检查用户是否登录
function is_login(){
	//使用global关键字使用$users数组
	global $users;
	//把COOKIE中的值赋与新变量
	$u = $_COOKIE["username"];
	$p = $_COOKIE["password"];
	//遍历用户数组
	foreach($users as $key=>$value){
		//比较COOKIE中的值与用户数组中的值
		if($value["username"]==$u and $value["password"]==$p){
			//如果COOKIE中的值与用户数组中的值有一对是相等的,返回TRUE
			return true;
		}
	}
	//遍历完数组后,没有相等的值,返回FALSE;
	return false;
}
//定义一个函数,设置用户登录后的COOKE
function login(){
	global $users;
	//把$_POST数组中的单元赋与新变量
	$u = $_POST["username"];
	$p = $_POST["password"];
	//遍历用户数组
	foreach($users as $key=>$value){
		//查找表单提交的变量,是否与用户数组中的一组值相等
		if($value["username"]==$u and $value["password"]==$p){
			//如果表单提交的变量等于数组中的值,设置COOKIE值,供is_login()函数检查
			setcookie("username",$value["username"]);
			setcookie("password",$value["password"]);
			setcookie("style",$value["style"]);
			//使用JavaScript显示登录信息,并转向用户页,本例为同一页
			echo "<script>alert('登录成功!');</script>";
			echo "<script>window.navigate('3_6.php');</script>";
			return true;
		}
	}
	//遍历完数组后,没有相等的数组,显示登录错误信息,并转向其他页,本例为同一页
	echo "<script>alert('用户名或密码错误!');</script>";
	echo "<script>window.navigate('3_6.php');</script>";
	return false;
}
//定义一个函数,用于删除COOKIE,完成注销工作
function logout(){
	//消除相关COOKE的值
	setcookie("username","");
	setcookie("password","");
	//显示注销成功信息
	echo "<script>alert('注销成功!');</script>";
	echo "<script>window.navigate('3_6.php');</script>";
}
//定义一个用户登录表单,用于用户提交登录数据.
function loginTable(){
print<<<EOT
<table width="300" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><form name="form1" method="post" action="?action=login">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>用户名:</td>
          <td><label>
            <input name="username" type="text" id="username">
          </label></td>
        </tr>
        <tr>
          <td>密码:</td>
          <td><label>
            <input name="password" type="password" id="password">
          </label></td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <input type="submit" name="Submit" value="提交">
          </label></td>
          </tr>
      </table>
        </form>
    </td>
  </tr>
</table>
EOT;
}
//根据外部变量,调用函数
switch($_GET["action"]){
	case "login":
		login();
	break;
	case "logout":
		logout();
	break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<title>用户登录</title>
<style>
.css{
width:800px;
height:20px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
.css1{
width:800px;
height:200px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
.css2{
background-color:#000000;
color:#ffffff;
width:800px;
height:200px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
.css3{
background-color:#FF0000;
color:#FFFF00;
width:800px;
height:200px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
.css4{
background-color:#000066;
color:#FFFFFF;
width:800px;
height:200px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
.css5{
background-color:#FFCC66;
color:#00CC00;
width:800px;
height:200px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
.css6{
background-color:#33CC99;
color:#996600;
width:800px;
height:200px;
FONT-SIZE: small; FONT-FAMILY: arial, helvetica, clean, sans-serif;
border:solid #CCCCCC 1px;
}
</style>
</head>
<body>
<?php
if(is_login()){
?>
<div class="css">你好:<?=$_COOKIE["username"];?>&nbsp;&nbsp;&nbsp;&nbsp;<a href='?action=logout'>注销</a></div>
<div class='<?=$_COOKIE["style"]?>'>用户登录后,显示的内容.</div>
<?php
}else{
	loginTable();
}
?>
</body>
</html>
