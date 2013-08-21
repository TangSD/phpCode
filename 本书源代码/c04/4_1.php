<!-------------------------------------------文件名： 4_1.php-------------------------------->
<?php
//链接数据库，并返回链接句柄，当链接失败时，显示错误信息
$link = mysql_connect("localhost","root","password") or die("数据库链接失败");
//选择作用数据库，失败时，显示错误信息
mysql_select_db("mysql",$link) or die("选择数据库失败！");
//使用mysql_query()运行sql语句，并返回结果集
$result = mysql_query("select * from help_topic limit 0,15");
//使用mysql_num_rows()函数，取得结果集中的记录数
$lines= mysql_num_rows($result);
echo "共有记录".$lines."条";
$table = "<table border='1'><tr><th>ID</th><th>名称</th><th>分类ID</th><th>链接</th></tr>";
//使用while循环，配合mysql_fetch_array()函数，遍历结果集
while($row = mysql_fetch_array($result)){
	//使用mysql_fetch_array()函数返回的数组中的数据
	$table .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[5]."</td></tr>";
}
$table .= "</table>";
echo $table;
//释放资料
mysql_free_result($result);
//关闭数据库链接
mysql_close($link);
?>