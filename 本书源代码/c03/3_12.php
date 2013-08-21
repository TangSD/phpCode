<!-------------------------------------------文件名： 3_12.php-------------------------------->
<?php
//定义一个函数用于检测电子邮件地址是否正常
function checkMail($mail){
	//使用ereg函数检查模式是否与邮件地址相匹配
	if(ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+",$mail)){
		echo "<b>检查的邮件地址是合法的</b>";
		return true;
	}else{
		echo "<b><font color='red'>检查的邮件地址是非法的</font></b>";
		return false;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>使用正则表达式检查电子邮件地址</title>
</head>
<body>
<?php
//检查是否表单是否提交了email变量,并且email变量不为空时运行邮件地址检查函数
if(isset($_POST["email"]) and $_POST["email"]!=""){
	//检查邮件地址,并返回检查结果s
	checkMail($_POST["email"]);
}
?>
<!-- 用于输入电子邮件地址的表单 -->
<form id="form" name="form" method="post" action="">
  <label>请输入电子邮件地址：
  <input name="email" type="text" id="email" />
  </label>
  <label>
  <input type="submit" name="Submit" value="提交" />
  </label>
</form>
</body>
</html>
