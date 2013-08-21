<?php
session_start();
//实例化user类
$user = new user();
//获取以GET方法提交的变量action的值
if(isset($_GET["action"])){

	switch(strval($_GET["action"])){
		case "register":
			$user->register();
		break;
		case "login":
			$user->login();
		break;
	}
}else{
	$user->auth();
}
//用于处理用户注册和登录的user类
class user{
	function register(){
		include_once("../c04/adodb5/adodb.inc.php");
		$conn = &ADONewConnection('mysql');
		$conn->Connect("localhost","root","password","examples");
		$vercode = strval($_POST["vercode"]);
		$name = strval($_POST["username"]);
		$pass1 = strval($_POST["pass1"]);
		$pass2 = strval($_POST["pass2"]);
		$sex = strval($_POST["sex"]);
		$email = strval($_POST["email"]);
		$error = "";
		if($vercode != $_SESSION["string"]){
			$error .= "认证码错误，请重新输入！<br>";
		}
		if(!ereg("([a-zA-Z0-9_]{4,14})", $name)){
			$error .= "用户名只允许大小写的英文字符、数字和下划线，字符数要大于4且小于14个字符<br>";
		}
		$us = $conn->Execute("select id from user where username = '".$name."'");
		if($us->RecordCount() == 1){
			$error .= "用户名已经存在，请选择其他用户名！<br>";
		}
		if(!ereg("([a-zA-Z0-9_]{4,14})", $pass1)){
			$error .= "密码只允许大小写的英文字符、数字和下划线，字符数要大于4且小于14个字符！<br>";
		}
		if($pass1 != $pass2){
			$error .= "两次输入的密码不相同！<br>";
		}
		if(!ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+",$email)){
			$error .= "输入的Email地址是非法的！<br>";
		}
		if($error == ""){
			$sql = "select id from user";
			$row = $conn->Execute($sql);
			if($row->RecordCount()== 0){
				$role = 1;
			}else{
				$role = 0;
			}
			$sql = "INSERT INTO `user` (`username`,`password`,`sex`,`email`,`role`) VALUES ('".$name."','".md5($pass1)."','".$sex."','".$email."','".$role."');";
			$result = $conn->Execute($sql);
			//关闭链接
			$conn->close();
			if($result == FALSE){
				echo "用户数据保存失败<br>错误信息：<pre>".$conn->ErrorMsg()."</pre>";
				exit();
			}else{
				echo "注册用户成功<br><br>" .
					 "<a href='11_2.php'>登录</a>，或等待页面自动跳转，请稍后..." .
				 	 "<script>setTimeout('window.location.href=\"11_2.php\"',3000);</script>";
				exit();
			}
		}else{
			echo "用户提交的注册信息有错误：<br>".$error."<br><br>" .
				 "请改正错误后，重试！<br><br>" .
				 "<a href='javascript:history.go(-1);'>返回上一步</a>，或等待页面自动跳转，请稍后..." .
				 "<script>setTimeout('history.go(-1)',3000);</script>";
			exit();
		}
	}
	function login(){
		$name = strval($_POST["username"]);
		$pass = strval($_POST["password"]);
		$code = strval($_POST["vercode"]);
		if($code != $_SESSION["string"]){
			echo "请输入正确的认证码<br><br>" .
				 "<a href='javascript:history.go(-1);'>返回上一步</a>，或等待页面自动跳转，请稍后..." .
				 "<script>setTimeout('history.go(-1)',3000);</script>";
			exit();
		}
		include_once("../c04/adodb5/adodb.inc.php");
		$conn = &ADONewConnection('mysql');
		$conn->Connect("localhost","root","password","examples");
		$sql = "select id,username,password,role from user where username = '".$name."' and password = '".md5($pass)."'";
		$row = $conn->Execute($sql);
		//关闭链接
		$conn->close();
		if($row->RecordCount()==1){
			$detail = $row->FetchRow();
			$_SESSION["auth"]["name"] = $detail[1];
			$_SESSION["auth"]["pass"] = $detail[2];
			$_SESSION["auth"]["role"] = $detail[3];
			echo "登录成功<br><br>" .
				 "<a href='11_3.php'>进入用户界面</a>，或等待页面自动跳转，请稍后..." .
			 	 "<script>setTimeout('window.location.href=\"11_3.php\"',3000);</script>";
			exit();
		}else{
			echo "用户名或密码错误<br><br>" .
				 "请改正错误后，重试！<br><br>" .
				 "<a href='javascript:history.go(-1);'>返回上一步</a>，或等待页面自动跳转，请稍后..." .
				 "<script>setTimeout('history.go(-1)',3000);</script>";
			exit();
		}
	}
	//用户身份验证
	function auth(){
		$name = strval($_SESSION["auth"]["name"]);
		$pass = strval($_SESSION["auth"]["pass"]);
		include_once("../c04/adodb5/adodb.inc.php");
		$conn = &ADONewConnection('mysql');
		$conn->Connect("localhost","root","password","examples");
		$sql = "select id,username,password,role from user where username = '".$name."' and password = '".$pass."'";
		$row = $conn->Execute($sql);
		//关闭链接
		$conn->close();
		if($row->RecordCount()!=1){
			echo "错误的用户登录信息<br><br>" .
				 "<a href='11_2.php'>跳转到用户登录界面</a>，或等待页面自动跳转，请稍后..." .
				 "<script>setTimeout('window.location.href=\"11_2.php\"',3000);</script>";
			exit();
		}
	}
	//检测用户权限信息
	function checkPoint($roleID,$role){
		include_once("../c04/adodb5/adodb.inc.php");
		$conn = &ADONewConnection('mysql');
		$conn->Connect("localhost","root","password","examples");
		$sql = "select detail from role where id = '".$roleID."'";
		$row = $conn->Execute($sql);
		$conn->close();
		$rows = $row->FetchRow();
		$roles = explode(",",$rows[0]);
		if(in_array($role,$roles)){
			return true;
		}else{
			return false;
		}
	}
}
?>
