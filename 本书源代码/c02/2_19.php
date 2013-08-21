<!-------------------------------------------文件名： 2_19.php-------------------------------->
<?php
$i=3;
echo "<strong>使用if语句判断变量值</strong><br>";
if($i==1){
	echo "当前数字是1";
}elseif($i==2){
	echo "当前数字是2";
}elseif($i==3){
	echo "当前数字是3";
}else{
	echo "未知数字";
}
echo "<br>";
echo "<strong>使用switch语句判断变量值</strong><br>";
switch($i){
	case 1:
		echo "当前数字是1";
	break;
	case 2:
		echo "当前数字是2";
	break;
	case 3:
		echo "当前数字是3";
	break;
	default:
		echo "未知数字";
	break;
}
echo "<br>";
$i=2;
echo "<strong>不同的值，指向相同的代码段</strong><br>";
if($i==1 or $i==2){
	echo "当前数字是1或者是2";
}elseif($i==3){
	echo "当前数字是3";
}else{
	echo "未知数字";
}
echo "<br><strong>switch语句的实现方法</strong><br>";
switch($i){
	case 1:
	case 2:
		echo "当前数字是1或者是2";
	break;
	case 3:
		echo "当前数字是3";
	break;
	default:
		echo "未知数字";
	break;
}
?>
