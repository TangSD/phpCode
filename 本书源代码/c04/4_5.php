<!---------------------------------------文件名： 4_5.php-------------------------------->
<?php
//包含ADODB文件
include_once('adodb5/adodb.inc.php');
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
//定义SELECT语句
$sql = "select name,help_topic_id from help_topic limit 0,15";
//运行SQL语句
$rs = $conn->Execute($sql);
//创建一个名为selectMenu1，默认选择内容为JOIN选项的下拉列表，并且第一行不为空
echo $rs->GetMenu("selectMenu1","JOIN",false);
//把记录指针移动到第一条记录处
$rs->MoveFirst();
//创建一个名为selectMenu2，默认不选择任何内容的下拉列表，并且设置第一行为空
echo $rs->GetMenu("selectMenu2","",true);
echo "<br>";
//把记录指针移动到第一条记录处
$rs->MoveFirst();
//创建一个名为selectMenu3，默认不选择任何内容的列表，并且设置第一行为空,同时支持多选，其高度为10
echo $rs->GetMenu("selectMenu3","",true,true,10);
//把记录指针移动到第一条记录处
$rs->MoveFirst();
//创建一个名为selectMenu3，默认不选择任何内容的列表，并且设置第一行为空,只支持单选，其高度为10
echo $rs->GetMenu("selectMenu4","",false,false,10);
?>
