<?php
/********************11_4.php**************************/
$string = "用于加密的字符串!";
//使用url相关函数加密解密
echo "使用urlencode()函数加密的字符串：";
echo $encode = urlencode($string);
echo "<br>使用urldecode()函数解码的字符串：";
echo urldecode($encode);
echo "<br>使用rawurlencode()函数加密的字符串";
echo $encode = rawurlencode($string);
echo "<br>使用rawurldecode()函数解密的字符串：：";
echo rawurldecode($encode);
echo "<br>使用base64_encode()函数加密的字符串：";
echo $encode = base64_encode($string);
echo "<br>使用base64_decode()函数解密的字符串：";
echo base64_decode($encode);
echo "<br>使用convert_uuencode()函数加密的字符串：";
echo $encode = convert_uuencode($string);
echo "<br>使用convert_uudecode()函数解密的字符串：";
echo convert_uudecode($encode);
echo "<br>使用htmlentities()函数加密的字符串：";
echo $encode = htmlentities($string);
echo "<br>使用html_entity_decode()函数解密的字符串：";
echo html_entity_decode($encode);
echo "<br>使用md5()函数加密取得的字符串的md5值：";
echo md5($string);
echo "<br>使用md5_file()函数取得的文件的md5值：";
echo md5_file("11_4.php");
echo "<br>使用sha1()函数加密取得的字符串的sha1值：";
echo sha1($string);
echo "<br>使用sha1_file()函数取得的文件的sha1值：";
echo sha1_file("11_4.php");
echo "<br>使用crc32()函数取得的文件的crc32值：";
echo crc32("11_4.php");
?>