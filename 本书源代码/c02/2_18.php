<!-------------------------------------------文件名： 2_18.php-------------------------------->
<?php
//for 循环嵌套使用
for($i=1;$i<=9;$i++){
	for($j=1;$j<=$i;$j++){
		echo "$j"."×".$i."=".$i*$j." ";
	}
	echo "<br>";
}
//for循环的无限循环方式
$i=0;
for(;;){
	//当$i>=5时，退出循环
	if($i>=5){
		break;
	}
	//退出无限循环的必要条件
	$i++;
}
//定义一个数组
$ar = array("a","b","c","d","e");
echo "使用for遍历数组<br>";
for($i=0;$i<=count($ar);$i++){
	echo $ar[$i]."<br>";
}
echo "使用foreach遍历数组<br>";
foreach($ar as $val){
	echo $val."<br>";
}
echo "使用foreach遍历数组的键名与值<br>";
foreach($ar as $key=>$val){
	echo "键名：".$key."值：".$val."<br>";
}
?>
