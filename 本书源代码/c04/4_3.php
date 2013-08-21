<?php
//<!---------------------------------------文件名： 4_3.php-------------------------------->
//包含ADODB文件
include_once('adodb5/adodb.inc.php');
//包含分页功能文件
include_once('adodb5/adodb-pager.inc.php');
//启动SESSION,传递数据
session_start();
//设置链接MySQL数据的变量
//数据库服务器地址
$host = "localhost";
//用户名
$user = "root";
//密码
$pass = "password";
//要操作的数据库
$db   = "mysql";
//建立链接对象
$conn = &ADONewConnection('mysql');
//链接数据库
$conn->Connect($host,$user,$pass,$db);
//设置字符集
$conn->Execute("SET NAMES gb2312");
//选择要分页的表
$sql = "select help_topic_id,name,help_category_id,url from help_topic";
//创建$pager对象
$pager = new ADODB_Pager($conn,$sql);
//初始化分页设置
$pager->first = "第一页";
$pager->prev = "上一页";
$pager->next = "下一页";
$pager->last = "最后一页";
$pager->gridAttributes='border="1" cellpadding="3" cellspacing="0"';
//设置每页显示3条记录
$pager->Render($rows_per_page=10);
?>
