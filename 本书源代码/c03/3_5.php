<!-------------------------------------------文件名： 3_5.php-------------------------------->
<?php
//初始化
$album = "album";
if(is_dir($album)!==true){
	mkdir($album);
}
//处理上传文件
if(isset($_POST["action"]) and $_POST["action"]=="upload"){
	if(isset($_FILES["file"]["tmp_name"])){
		//定义文件存放的目录
		//定义新的文件名,此处使用原文件名
		$filename = $_FILES["file"]["name"];
		//使用move_uploaded_file()把上传的临时文件,移动到新目录
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$album."/".$filename)){
			echo "上传文件成功!";
		}else{
			echo "上传文件失败!";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>相册</title>
<style>
body{margin:0px;padding:0px;background-color: #EFEFEF;font-size:12px;}
ul{	margin:0px;	padding:0px;list-style:none;}
a{color:#333333;text-decoration:none;}
a:hover{color:#999999;}
.ablum_out{width:98%px;margin-left:10px;margin-top:10px;}
.ablum_out img{margin:4px;border:#ccc 1px solid;}
.ablum_out li{float:left;width:180px;text-align:center;margin:5px;}
</style>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label>上传图像
  <input type="file" name="file" />
  </label>
  <label>
  <input type="submit" name="Submit" value="提交" />
  <input type="hidden" name="action" value="upload"/>
  </label>
</form>
<hr size="1" />
		<div class="ablum_out">
			<ul>
<?php
$dh = dir($album);
echo "相册目录: " . $dh->path . "<br>";
while (false !== ($file = $dh->read())) {
   if($file != "." and $file != ".."){
   	echo '<li><a href="'.$album."/".$file.'" target="_blank"><img src="'.$album."/".$file.'" width="160" height="120" border="0" /><br />'.$file.'</a> </li>';
   }
}
$dh->close();
?>
			</ul>
	</div><br/>
</body>
</html>
