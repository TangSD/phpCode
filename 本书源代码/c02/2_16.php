<!-------------------------------------------文件名： 2_16.php-------------------------------->
<?php
//自定义变量
$n1  = "Tom";
$n2  = "Kite";
$m1 = "中学";
$m2 = "大学";
$m3 = "蓝球队员";
$m4 = "啦啦队员";
//使用if elseif else语句判断条件
function s($age,$sex){
	global $n1,$n2,$m1,$m2,$m3,$m4;
	$string = "";
	if($sex == 1){
		$string .= $n1;
		if($age>=18){
			$string .= "是".$m2.$m3;
		}else{
			$string .= "是".$m1.$m3;
		}
	}elseif($sex==0){
		$string .= $n2;
		if($age>=18){
			$string .= "是".$m2.$m4;
		}else{
			$string .= "是".$m1.$m4;
		}
	}else{
		$string .= "无法判断性别";
	}
	echo $string;
}
s(19,1);
echo "<br>";
s(17,0);
?>
