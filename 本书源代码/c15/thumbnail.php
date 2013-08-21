<?php
if(isset($_GET["image"])){
	$width = "";
	$height = "";
	$type = "";
	//使用exif_thumbnail()函数读取数据
	$image = exif_thumbnail($_GET["image"], $width, $height, $type);
	if($image===false) {
		echo "没有缩略图数据！";
	}else{
		//当缩略图数据存在时，向浏览器发送文件类型，并输入缩略图内容
	    header("Content-type: ".image_type_to_mime_type($type));
	    print $image;
	    exit;
	}	
}else{
	echo "没有缩略图数据！";
}
?>