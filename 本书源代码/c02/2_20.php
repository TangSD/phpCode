<!-------------------------------------------文件名： 2_20.php-------------------------------->
<?php
echo "<strong>在循环中使用continue</strong><br>";
for($i=1;$i<=6;$i++){
	if($i==4){
		continue;
	}
	echo $i."<br>";
}
echo "<strong>在循环中使用break</strong><br>";
for($i=1;$i<=6;$i++){
	if($i==4){
		break;
	}
	echo $i."<br>";
}
?>
