<!-------------------------------------------文件名： 3_1.php-------------------------------->
<?php
/*************************设置变量************************************/
$teacher = array("老张","28","讲师");
$student = array(
	array("小李",19,"计算机"),
	array("小张",18,"计算机"),
	array("小刘",19,"计算机"),
	array("小苑",20,"计算机"),
	array("小吴",20,"计算机"),
	array("小王",20,"计算机"),
	array("小朱",18,"计算机")
);
//使用list()读取$teacher数组
list($tname,$tage,$tjob) = $teacher;
echo "姓名：".$tname."，今年".$tage."岁，职业：".$tjob;
//使用each()返回数组的键/值
$kv = each($student);
echo "<pre>";
print_r($kv);
echo "</pre>";
//使用list()、each()配合while读取二维数组并转化为表格。
$table = "<table border='1'><tr><th>姓名</th><th>年龄</th><th>专业</th></tr>";
while(list($key,$val)=each($student)){
	$table .= "<tr><td>".$val[0]."</td><td>".$val[1]."</td><td>".$val[2]."</td></tr>";
}
$table .= "</table>";
echo $table;
?>
