<!-------------------------------------------文件名： 3_4.php-------------------------------->
<?php
//定义一个变量，其值为要打开的文件
$file = "do.txt";
//使用fopen()函数打开文件，打开方式是w.并使用判读打开状态。
if(false === ($fp = fopen($file,"w"))){
	echo "打开文件失败！<br>";
}else{
	echo "文件打开成功！<br>";
}
//定义变量，存储写入文件的内容
$c = "写入do.txt文件的内容";
//使用fwrite()函数写入文件，并判读写入状态。
if(fwrite($fp,$c,strlen($c))===false){
	echo "文件写入失败！<br>";
}else{
	echo "文件写入成功！<br>";
}
//关闭文件句柄
fclose($fp);
//使用fopen()打开文件，打开方式是r
$fp = fopen($file,"r");
//使用fread()读取文件的前8192个字节。
echo "<br>显示读取的文件内容：<br>".fread($fp,8192);
//关闭文件句柄
fclose($fp);
//访问大型文件
$handle = fopen("http://www.baidu.com","r");
$contents = "";
//循环读取文件
while (!feof($handle)){
	//如果没有到文件尾，继续读取文件
	$contents .= fread($handle, 8192);
}
fclose($handle);
echo $contents;
//使用file_put_contents()函数，向文件写入内容，并判读写入状态
if(file_put_contents($file,"使用file_put_contents()函数写入的内容。")>0){
	echo "<br>使用file_put_contents()函数写入文件成功！<br>";
}else{
	echo "<br>使用file_put_contents()函数写入文件失败！<br>";
}
//使用file_get_contents()函数读取文件内容，并显示
$get = file_get_contents($file);
echo "<br>使用file_get_contents()函数读取的文件内容：<br>".$get;
?>
