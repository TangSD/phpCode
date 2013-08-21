<?php
session_start();
//<!---------------------------------------文件名： 4_6.php-------------------------------->
//包含ADODB文件
include_once('adodb5/adodb.inc.php');
include_once('adodb5/tohtml.inc.php');
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
//使用SESSION记录当前页码
session_register('current_page_number');
//设置每一页的记录数
$numofpage = 10;
$sql = 'select help_topic_id,name,help_category_id,url from help_topic';

if (isset($HTTP_GET_VARS['next_page']))
        $current_page_number = $HTTP_GET_VARS['next_page'];
if (empty($current_page_number)) $current_page_number = 1; ## at first page
//使用PageExecute()函数，取得资源句柄
$rs = $conn->PageExecute($sql, $numofpage, $current_page_number);
//如果记录指针不在尾部，并且不在第一页或最后一页，显示分页链接
if (!$rs->EOF && (!$rs->AtFirstPage() || !$rs->AtLastPage())){
	//如果当前显示记录不是第一页，显示上一页分页链接
	if (!$rs->AtFirstPage()){
		echo '<a href="'.$PHPSELF.'?next_page='.($rs->AbsolutePage() - 1).'">上一页</a>';
	}
	//如果记录显示的不是最后一页，显示下一页分页链接
	if(!$rs->AtLastPage()){
		echo '<a href="'.$PHPSELF.'?next_page='.($rs->AbsolutePage() + 1).'">下一页</a>';
	}
	//使用rs2html()函数，显示数据
	rs2html($rs);
}
?>
