<!-------------------------------------------文件名： 3_10.php-------------------------------->
<?php
$code = "加密字符串";
echo "没有经过加密的字符串：".$code."<br>";
$encode = convert_uuencode($code);
echo "经过convert_uuencode()函数加密的字符串：".$encode."<br>";
$decode = convert_uudecode($encode);
echo "使用convert_uudecode()函数解密的字符串：".$decode."<br>";
//定义一个含有MD5值的字符串
$havemd5 = "3e33ee01c1ef9c0c15612f48be27dae6";
$md5code = md5($decode);
echo "使用md5()函数加密的字符串：".$md5code."<br>";
if($havemd5==$md5code){
	echo "字符中MD5相等，继续演示代码！<br>";
}else{
	echo "字符中MD5不相等，结束演示代码！<br>";
	exit();
}
$md5file = md5_file("3_10.php");
echo "当前文件的MD5值：".$md5file."<br>";
//自定义加密函数
function encode($str){
	//定义一个字符串，用于存储加密后的字符串
	$encode = "";
	//定义一个密钥数字
	$key = 12;
	//依次转换字符的ASCII码，与密钥数字相加后，再转化为字符
	for($i=0;$i<=strlen($str);$i++){
		$encode .= chr(ord($str[$i])+$key);
	}
	//返回转换后的字符串
	return convert_uuencode($encode);
}
//自定义解密函数
function decode($str){
	//定义一个字符串，用于存储解密后的字符串
	$decode = "";
	//定义一个密钥数字，应与加密函数中的密钥相同
	$key = 12;
	$destr = convert_uudecode($str);
	//依次转换字符的ASCII码，与密钥数字相减后，再转化为字符
	for($i=0;$i<=strlen($destr);$i++){
		$decode .= chr(ord($destr[$i])-$key);
	}
	//返回转换后的字符串
	return $decode;
}
$userEncode = encode($decode);
echo "使用自定义函数encode()加密的字符串：".$userEncode."<br>";
$userDecode = decode($userEncode);
echo "使用自定义函数decode()解密的字符串：".$userDecode;
?>