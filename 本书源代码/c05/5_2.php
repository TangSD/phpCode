<!---------------------------------------文件名： 5_2.php-------------------------------->
<?php
//检查上传的临时文件是否存在
if(isset($_POST["Submit"]) and $_POST["Submit"] == "提交"){
	//定义文件存放的目录
	$dir = "html";
	if(is_dir($dir)==false){
		mkdir($dir);
	}
	$message = "";
	for($i=1;$i<=count($_FILES["file"]["name"]);$i++){
		//定义新的文件名,此处使用原文件名
		$filename = $_FILES["file"]["name"][$i];
		//使用move_uploaded_file()把上传的临时文件,移动到新目录
		if(move_uploaded_file($_FILES["file"]["tmp_name"][$i],$dir."/".$filename)){
			$message .= $_FILES['file']['name'][$i]."上传文件成功!<br>";
		}else{
			$message .= $_FILES['file']['name'][$i]."上传文件失败!<br>";
		}
	}
	echo $message;
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
<div id="filehtml">
  选择上传文件1: <input type="file" name="file[1]" /><br>
  选择上传文件2: <input type="file" name="file[2]" /><br>
  选择上传文件3: <input type="file" name="file[3]" /><br>
</div>

  <input type="button" name="addfile" value="增加文件域" onclick="addFileHtml();"/>

<br>

  <input type="submit" name="Submit" value="提交"/>


</form>
<script language="JavaScript" type="text/javascript">
function addFileHtml(){
	var form = document.getElementById('sendfile');
	var count = 0;
	for(var i=0; i<form.elements.length; i++){
		var name = form.elements[i].name;
		if(name.indexOf("file") > -1) count++;
	}
	document.getElementById("filehtml").innerHTML += '选择上传文件'+count+': <input type="file" name="file['+count+']" /><br>';
}
</script>

</body>
</html>
