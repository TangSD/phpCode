<?php
/********************11_5.php**************************/
//加密函数
function encode($string){
	$newString = array();
	$encode = base64_encode($string);
	for($i=0;$i<2;$i++){
		$newString[$i] = substr($encode,($i*1)*(strlen($encode)/2),strlen($encode)/2);
	}
	$new = $newString[1].$newString[0];
	return base64_encode($new);
}

//解密
function decode($string)
{
	$newString = array();
	$encode = base64_decode($string);
	for($i=0;$i<2;$i++){
		$newString[$i] = substr($encode,($i*1)*(strlen($encode)/2),strlen($encode)/2);
	}
	return base64_decode($newString[1].$newString[0]);
}
echo encode("测试用字符串");
echo "<br>";
echo decode("MTlhMys3U3VzdUxLMU5QRA==");
?>