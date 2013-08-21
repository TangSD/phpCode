<!-------------------------------------------文件名： 3_3.php-------------------------------->
<?php
echo "<strong>使用目录函数读取目录</strong><br>";
$dir = "html";
//使用opendir()函数打开目录
$handle = opendir($dir);
if($handle == false){
	echo "打开目录失败!";
}else{
	echo "目录句柄: " . $handle . "<br>";
	echo "目录名称: " . $dir . "<br>";
	//使用readdir()读取目录信息
	while($file = readdir($handle)){
		if($file !== false){
			echo $file."<br>";
		}
	}
	
}
//使用closedir()关闭目录句柄
closedir($handle);
echo "<strong>使用Directory类读取目录</strong><br>";
$dh = dir($dir);
echo "目录句柄: " . $dh->handle . "<br>";
echo "目录名称: " . $dh->path . "<br>";
while ($file = $dh->read()) {
	if($file !== false){
   		echo $file."<br>";		
	}
}
$dh->close();
?>
