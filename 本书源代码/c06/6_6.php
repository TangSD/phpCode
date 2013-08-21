<!---------------------------------------文件名： 6_6.php-------------------------------->
<?php
//检查上传的临时文件是否存在
if(isset($_FILES["file"]["tmp_name"]) and $_FILES["file"]["type"]=="application/x-zip-compressed"){
	$filename = $_FILES["file"]["name"];
	//使用move_uploaded_file()把上传的临时文件,移动到当前目录
	if(move_uploaded_file($_FILES["file"]["tmp_name"],$filename)){
		//引用zip.php文件
		include_once("zip.php");
		//实例化zip类
		$zip = new zip();
		//使用zip类中的get_List()函数返回ZIP文件中的文件名数组
		$filenames = $zip->get_List($filename);
		//使用zip类中的Extract()函数，解压ZIP中的文件到zip目录下
		$zstat = $zip->Extract($filename,"zip");
		echo "<pre>";
		echo "ZIP文件中的所有文件名：<br>";
		print_r($filenames);
		echo "ZIP文件解压后，单个文件的解压情况数组";
		print_r($zstat);
		echo "</pre>";

	}else{
		echo "上传文件失败!";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>上传ZIP文件</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="sendfile">
  <label>选择ZIP文件:
  <input type="file" name="file" />
  </label>
  <label>
  <input type="submit" name="Submit" value="提交" />
  </label>
</form>
</body>
</html>
