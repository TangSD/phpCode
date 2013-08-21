<!-------------------------------------------文件名： 3_2.php-------------------------------->
<?php
/*************************设置变量************************************/
$student = array(
	array("小李",19,"计算机"),
	array("小张",18,"计算机"),
	array("小刘",19,"计算机"),
	array("小苑",20,"计算机"),
	array("小吴",20,"计算机"),
	array("小王",20,"计算机"),
	array("小朱",18,"计算机")
);
echo "使用for遍历二维数组并转化为表格。";
$table = "<table border='1'><tr><th>姓名</th><th>年龄</th><th>专业</th></tr>";
for($i=0;$i<=count($student);$i++){
	$table .= "<tr><td>".$student[$i][0]."</td><td>".$student[$i][1]."</td><td>".$student[$i][2]."</td></tr>";
}
$table .= "</table>";
echo $table;
echo "使用foreach遍历二维数组并转化为表格。";
$table = "<table border='1'><tr><th>姓名</th><th>年龄</th><th>专业</th></tr>";
foreach($student as $key=>$val){
	$table .= "<tr><td>".$val[0]."</td><td>".$val[1]."</td><td>".$val[2]."</td></tr>";
}
$table .= "</table>";
echo $table;
?>
