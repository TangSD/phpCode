<!-------------------------------------------文件名： 4_2.php-------------------------------->
<?php
//包含adodb文件
include_once("adodb5/adodb.inc.php");
//设置链接MySQL数据的变量
//数据库服务器地址
$host = "localhost";
//用户名
$user = "root";
//密码
$pass = "password";
//要操作的数据库
$db   = "mysql";
//建立链接对象，并设置链接数据库的类型
$conn = &ADONewConnection('mysql');
// 连接数据库
// 例如:$conn->Connect('主机','使用者','密码','数据库');
// 持续性连接，可使用PConnect()方法
// 例如:$conn->PConnect('主机','使用者','密码','数据库');
$conn->Connect($host,$user,$pass,$db);
// 要不要显示调试信息量，false 不要，true 要。
// 例如:$conn->debug = false;
//设置为显示调试信息
$conn->debug = true;
//设置字符集
$conn->Execute("SET NAMES gb2312");
//设置SQL语句
$sql = "select * from help_topic limit 0,15";
//执行SQL语句
$result = $conn->Execute($sql);
//检查返回的结果集，若返回FALSE,显示错误信息
if($result == FALSE){
	echo "<pre>".$conn->ErrorMsg()."</pre>";
}else{
	//使用FetchRow()方法,把返回结果以数组形式赋与$row
	$table = "<table border='1'><tr><th>ID</th><th>名称</th><th>分类ID</th><th>链接</th></tr>";
	while($row = $result->FetchRow()){
		//绘制表格内容
		$table .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[5]."</td></tr>";

	}
	$table .= "</table>";
	echo $table;
}
//关闭链接
$conn->close();
?>