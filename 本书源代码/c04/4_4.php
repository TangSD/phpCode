<!---------------------------------------文件名： 4_4.php-------------------------------->
<?php
//包含ADODB文件
include_once('adodb5/adodb.inc.php');
//包含分页功能文件
include_once('adodb5/toexport.inc.php');
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
//定义SELECT语句
$sql = "select help_topic_id,name,help_category_id,url from help_topic limit 0,15";
//运行SQL语句
$rs = $conn->Execute($sql);
//输出CSV文件内容到浏览器
print "<pre>";
print rs2csv($rs);
print "</pre>";
//移动到第一条记录
$rs->movefirst();
//新建一个文件，用于保存CSV数据
$fp = fopen("csv.txt","wb");
//使用rs3csvfile()函数，输出csv文件
rs2csvfile($rs,$fp);
fclose($fp);
?>
