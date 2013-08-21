<!---------------------------------------文件名： 5_1.php-------------------------------->
<?php
//检查上传的临时文件是否存在
if(isset($_FILES["file"]["tmp_name"])){
	//定义文件存放的目录
	$dir = "html/";
	//定义新的文件名,此处使用原文件名
	$filename = $_FILES["file"]["name"];
	//使用move_uploaded_file()把上传的临时文件,移动到新目录
	if(move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$filename)){
		echo "上传文件成功!";
	}else{
		echo "上传文件失败!";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>上传文件</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="sendfile">
  <label>选择上传文件:
  <input type="file" name="file" />
  </label>
  <label>
  <input type="submit" name="Submit" value="提交" />
  </label>
</form>
</body>
</html>
