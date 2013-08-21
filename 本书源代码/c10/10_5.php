<?php
/*********************10_5.php*******************************/
//引用包含smtp类的文件
include("smtp.php");
//设置SMTP服务器
$smtpHost = "smtp.sina.com";
//SMTP服务器端口，默认为25
$port =25;
//SMTP服务器上注册的用户邮箱的地址
$From = "发件人邮箱@sina.com";
//收件人电子邮箱地址
$to = "收件人邮箱@sina.com";
//SMTP服务器的用户帐号
$authuser = "SMTP主机认证用户名";
//SMTP服务器的用户密码
$authpass = "SMTP主机认证密码";
//邮件主题
$subject = "主题：SMTP测试";
//邮件内容
$body = "<font color=red>欢迎使用SMTP类发送电子邮件</font>";
//邮件类型
$type = "HTML";
//实例化smtp类
$smtp = new smtp($smtpHost,$port,$authuser,$authpass);
//发送电子邮件
$smtp->sendmail($to, $From, $subject, $body, $type);
?>
