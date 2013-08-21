<?php
//<!---------------------------------------文件名： 5_4.php-------------------------------->
//首选创建一个上传类，类的名称就叫做upload
class upload{
	//定义类中使用到的变量
	//用于存储产生的错误信息
	var $error = "";
	//存储客户端提交的文件信息
	var $uploadFile = "";
	//存储文件的mime值，默认为text/plain
	var $mimeType = "text/plain";
	//用于存放mime值的数组
	var $filterType = array();
	//用于存储可上传文件类型的变量
	var $Filter = "";
	//设置可上传文件大小
	var $fileSize = 1024;
	//设置上传目录,默认值为html
	var $path = "html";
	//设置重命名开关
	var $rename = true;
	var $ext = "";//用于存储文件扩展名
	var $stat = false;//用于存储文件上传状态
	//使用构建函数，初始化类
	function __construct($files,$path="html",$rename="true"){
		//设置上传路径
		$this->path = $path;
		//设置$filterType数组
		$this->filterType();
		//设置$Filter数组
		$this->Filter();
		//设置上传文件
		$this->uploadFile = $files;
		//设置重命名开关
		$this->rename = $rename;
		//开始上传文件
		$this->uploadFile();
	}
	//构建下载文件函数
	function uploadFile(){
		$file = $this->uploadFile;
		if(isset($file["tmp_name"]) and file_exists($file["tmp_name"])){
			//定义临时文件变量
			$tmp = $file["tmp_name"];
			$name = $file["name"];
			//定义文件存放的目录
			$dir = $this->path;
			//使用checkFileType()函数检查上传文件是否合法
			if($this->checkFileType($name,$tmp)==false){
				return false;
				exit();
			}
			if($this->checkFileSize($tmp)==false){
				return false;
				exit();
			}
			//根据重命名开关，处理新文件名
			if($this->rename == true){
				$filename = $this->newName().".".$this->ext;
			}else{
				$filename = $file["name"];
			}
			//使用move_uploaded_file()把上传的临时文件,移动到新目录
			if(move_uploaded_file($tmp,$dir."/".$filename)){
				$this->stat = true;
				return true;
			}else{
				$this->stat = false;
				$this->error .= "文件上传失败！<br>";
				return false;
			}
		}else{
			$this->error .= "上传文件不存在！<br>";
			return false;
		}
	}
	//创建新文件名
	function newName(){
		return time();
	}
	//用于设置上传文件大小
	function setFileSize($size){
		$this->fileSize = $size;
	}
	//检查文件大小是否合法
	function checkFileSize($file){
		$filesize = filesize($file);
		if($filesize <= $this->fileSize){
			return true;
		}else{
			$this->error .= "上传文件大于设置文件大小！";
			return false;
		}
	}
	//检查文件类型
	function checkFileType($filename,$file){
		//取得文件的扩展名
		$ext = strtolower(end(explode(".",$filename)));
		$this->ext = $ext;
		//检查上传文件的扩展名，是否在$this->Filter数组中
		//如果上传文件的扩展名在$this->Filter数组中，即允许上传
		if(in_array($ext,$this->Filter)){
			//使用function _exists()函数检查mime_content_type()函数是否存在
			if(function_exists("mime_content_type")){
				//如果mime_content_type()函数存在，使用其取得文件的mime值
				$this->mimeType = mime_content_type($file);
			}else{
				//如果mime_content_type()函数不存在，使用$this->filterType取得mime值
				if(isset($this->filterType[$ext])){
					$this->mimeType = $this->filterType[$ext];
				}
			}
			//如果获取mime值后，$this->mimeType值依然为空，显示错误信息
			if(empty($this->mimeType)){
				$this->error .= "获取文件类型出错";
				return false;
			}else{
				return true;
			}
		}else{
			$this->error .= "此文件类型不允许上传！<br>";
			return false;
		}
	}
	/**
	 * 文件上传统计
	 * 通过本函数，可以把文件上传的信息存储到文件或数据库中
	 * 供以后下载时使用
	 * */
	function saveUpload(){
		//文件上传统计函数
	}
	//取得错误信息
	function getError(){
		return $this->error;
	}
	/**
	 * 设置允许上传的文件扩展名
	 * 例如：txt、html、php、exe、js等
	 * */
	function Filter(){
		//本上传类，只允许上传.txt的文件，用户可以通过本函数，设置更多支持更多的文件上传类
		$this->Filter = array("txt","zip");
	}
	//用于填充$this->filterType数组
	function filterType(){
	    $this->filterType['chm']='application/octet-stream';
	    $this->filterType['ppt']='application/vnd.ms-powerpoint';
	    $this->filterType['xls']='application/vnd.ms-excel';
	    $this->filterType['doc']='application/msword';
	    $this->filterType['exe']='application/octet-stream';
	    $this->filterType['rar']='application/octet-stream';
	    $this->filterType['js']="javascript/js";
	    $this->filterType['css']="text/css";
	    $this->filterType['hqx']="application/mac-binhex40";
	    $this->filterType['bin']="application/octet-stream";
	    $this->filterType['oda']="application/oda";
	    $this->filterType['pdf']="application/pdf";
	    $this->filterType['ai']="application/postsrcipt";
	    $this->filterType['eps']="application/postsrcipt";
	    $this->filterType['es']="application/postsrcipt";
	    $this->filterType['rtf']="application/rtf";
	    $this->filterType['mif']="application/x-mif";
	    $this->filterType['csh']="application/x-csh";
	    $this->filterType['dvi']="application/x-dvi";
	    $this->filterType['hdf']="application/x-hdf";
	    $this->filterType['nc']="application/x-netcdf";
	    $this->filterType['cdf']="application/x-netcdf";
	    $this->filterType['latex']="application/x-latex";
	    $this->filterType['ts']="application/x-troll-ts";
	    $this->filterType['src']="application/x-wais-source";
	    $this->filterType['zip']="application/zip";
	    $this->filterType['bcpio']="application/x-bcpio";
	    $this->filterType['cpio']="application/x-cpio";
	    $this->filterType['gtar']="application/x-gtar";
	    $this->filterType['shar']="application/x-shar";
	    $this->filterType['sv4cpio']="application/x-sv4cpio";
	    $this->filterType['sv4crc']="application/x-sv4crc";
	    $this->filterType['tar']="application/x-tar";
	    $this->filterType['ustar']="application/x-ustar";
	    $this->filterType['man']="application/x-troff-man";
	    $this->filterType['sh']="application/x-sh";
	    $this->filterType['tcl']="application/x-tcl";
	    $this->filterType['tex']="application/x-tex";
	    $this->filterType['texi']="application/x-texinfo";
	    $this->filterType['texinfo']="application/x-texinfo";
	    $this->filterType['t']="application/x-troff";
	    $this->filterType['tr']="application/x-troff";
	    $this->filterType['roff']="application/x-troff";
	    $this->filterType['shar']="application/x-shar";
	    $this->filterType['me']="application/x-troll-me";
	    $this->filterType['ts']="application/x-troll-ts";
	    $this->filterType['gif']="image/gif";
	    $this->filterType['jpeg']="image/pjpeg";
	    $this->filterType['jpg']="image/pjpeg";
	    $this->filterType['jpe']="image/pjpeg";
	    $this->filterType['ras']="image/x-cmu-raster";
	    $this->filterType['pbm']="image/x-portable-bitmap";
	    $this->filterType['ppm']="image/x-portable-pixmap";
	    $this->filterType['xbm']="image/x-xbitmap";
	    $this->filterType['xwd']="image/x-xwindowdump";
	    $this->filterType['ief']="image/ief";
	    $this->filterType['tif']="image/tiff";
	    $this->filterType['tiff']="image/tiff";
	    $this->filterType['pnm']="image/x-portable-anymap";
	    $this->filterType['pgm']="image/x-portable-graymap";
	    $this->filterType['rgb']="image/x-rgb";
	    $this->filterType['xpm']="image/x-xpixmap";
	    $this->filterType['txt']="text/plain";
	    $this->filterType['c']="text/plain";
	    $this->filterType['cc']="text/plain";
	    $this->filterType['h']="text/plain";
	    $this->filterType['html']="text/html";
	    $this->filterType['htm']="text/html";
	    $this->filterType['htl']="text/html";
	    $this->filterType['rtx']="text/richtext";
	    $this->filterType['etx']="text/x-setext";
	    $this->filterType['tsv']="text/tab-separated-values";
	    $this->filterType['mpeg']="video/mpeg";
	    $this->filterType['mpg']="video/mpeg";
	    $this->filterType['mpe']="video/mpeg";
	    $this->filterType['avi']="video/x-msvideo";
	    $this->filterType['qt']="video/quicktime";
	    $this->filterType['mov']="video/quicktime";
	    $this->filterType['moov']="video/quicktime";
	    $this->filterType['movie']="video/x-sgi-movie";
	    $this->filterType['au']="audio/basic";
	    $this->filterType['snd']="audio/basic";
	    $this->filterType['wav']="audio/x-wav";
	    $this->filterType['aif']="audio/x-aiff";
	    $this->filterType['aiff']="audio/x-aiff";
	    $this->filterType['aifc']="audio/x-aiff";
		$this->filterType['swf']="application/x-shockwave-flash";
	}
}
//检查上传请求
if(isset($_GET["action"]) and $_GET["action"]=="upload") {
	//初始化download类
	$up = new upload($_FILES["file"]);
	//如果文件上传成功，显示上传成功信息
	if($up->stat==true){
		echo "文件上传成功！";
		exit();
	}else{
		//如果上传失败，显示错误信息。
		echo $up->getError();
		exit();
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
<form action="?action=upload" method="post" enctype="multipart/form-data" name="sendfile">
  <label>选择上传文件:
  <input type="file" name="file" />
  </label>
  <label>
  <input type="submit" name="Submit" value="上传" />
  </label>
</form>
</body>
</html>

