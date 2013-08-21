<!-------------------------------------------文件名： 2_17.php-------------------------------->
<?php
//while 循环嵌套使用
$i = 1;
while($i<=9){
	$j=1;
	while($j<=$i){
		echo "$j"."×".$i."=".$i*$j." ";
		$j++;
	}
	echo "<br>";
	$i++;
}
$n = 5;
$m = 5;
//建立一个无限循环
while(TRUE){
	//当满足条件时,从while循环中跳出
	if($n == $m){
		echo $n;
		//跳出while循环
		break;
	}
	$n++;
}
echo "<br>";
//建立一个do-while无限循环
$n = 0;
do{
	//当满足条件时,从do-while循环中跳出
	if($n == $m){
		echo $n;
		//跳出do-while循环
		break;
	}
	$n++;
}while(TRUE);
?>
