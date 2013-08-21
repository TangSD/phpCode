<!---------------------------------------文件名： 6_5.php-------------------------------->
<?php
//定义变量
$string = "I 服了 YOU！";
$url_s1 = "SSC3/sHLIFlPVaOh";
$url_s2 = "I%20%B7%FE%C1%CB%20YOU%A3%A1";
$url_s3 = "I+%B7%FE%C1%CB+YOU%A3%A1";
$url = "http://user:password@www.rzphp.com/index.php?action=show";
$url_array = array("action"=>"show","title"=>"中文");
echo "<pre>";
echo "使用parse_url()函数，分析$"."url变量:<br>";
print_r(parse_url($url));
echo "使用http_build_query()函数创建URL字符串：".http_build_query($url_array)."<br>";
//编码含有中英文的字符串
echo "使用base64_decode()函数编码：".base64_encode($string)."<br>";
echo "使用rawurlencode()函数编码：".rawurlencode($string)."<br>";
echo "使用urlencode()函数编码：".urlencode($string)."<br>";
//解码字符串
echo "使用base64_decode()函数解码：".base64_decode($url_s1)."<br>";
echo "使用rawurldecode()函数解码：".rawurldecode($url_s2)."<br>";
echo "使用urlencode()函数解码：".urldecode($url_s3)."<br>";
echo "</pre>";
?>
