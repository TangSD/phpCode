<?php
//<!---------------------------------------文件名： 5_5.php-------------------------------->
//首选创建一个下载类，类的名称就叫做download
class download{
	//定义类中使用到的变量
	//用于存储产生的错误信息
	var $error = "";
	//存储下载文件名称
	var $downFile = "";
	//存储下载文件的mime值，默认为text/plain
	var $mimeType = "text/plain";
	//用于存放mime值的数组
	var $filterType = array();
	//用于存储可上传文件类型的变量
	var $Filter = "";
	//使用构建函数，初始化类
	function __construct($filename){
		//设置$filterType数组
		$this->filterType();
		//设置$Filter数组
		$this->Filter();
		//设置上传文件
		$this->downFile = $filename;
		//下载文件
		$this->downFile();
	}
	//构建下载文件函数
	function downFile(){
		//使用checkFileType()函数检查下载文件是否合法
		if($this->checkFileType()){
			//取得文件名称
			$filename = end(explode('/',strtr($this->downFile,'\\','/')));
			//输入头信息
			header("Pragma:public");
			header("Expires:0");
			header("Cache-Component:must-revalidate,post-check=0,pre-check=0");
			header("Content-type:".$this->mineType);
			header("Content-Length:".filesize($this->downFile));
			header("Content-Disposition:attachment;filename=".$filename);
			header("Content-Transfer-Encoding:binary");
			//输出文件到缓冲区
			readfile($this->downFile);
			return true;
		}else{
			return false;
		}
	}
	//检查文件类型
	function checkFileType(){
		//检查下载的文件是否存在
		if(file_exists($this->downFile)){
			//取得文件的扩展名
			$ext = strtolower(end(explode(".",$this->downFile)));
			//检查下载文件的扩展名，是否在$this->Filter数组中
			//如果下载文件的扩展名在$this->Filter数组中，即允许下载
			if(in_array($ext,$this->Filter)){
				//使用function _exists()函数检查mime_content_type()函数是否存在
				if(function_exists("mime_content_type")){
					//如果mime_content_type()函数存在，使用其取得文件的mime值
					$this->mimeType = mime_content_type($this->downFile);
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
				$this->error .= "此文件类型不允许下载！<br>";
				return false;
			}
		}else{
			$this->error .= "文件不存在！<br>";
			return false;
		}
	}
	/**
	 * 文件下载统计
	 * 本下载类把文件统计信息存放在下载文件中
	 * 在实际应用中，可以修改这个函数
	 * 把统计信息存放在数据库中
	 * */
	function countDownload(){
		$count = file_get_contents($this->downFile);
		$fp = fopen($this->downFile,"w");
		if($count==""){
			$count = 0;
		}
		$count++;
		fwrite($fp,$count,strlen($count));
		fclose($fp);
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
		//本下载类，只允许下载.txt的文件
		$this->Filter = array("txt");
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
//模拟数据库存储的文件列表
$files = array(
	1=>array("html/1.txt")
);
//检查下载请求
if(isset($_GET["action"]) and $_GET["action"]=="download") {
	//取得数组的键值
	$fid = $_GET["fid"];
	//根据键值，取得下载文件名称
	$filename = $files[$fid][0];
	//初始化download类
	$down = new download($filename);
	//如果下载成功，结束代码运行
	if($down==true){
		exit();
	}else{
		//如果下载失败，显示错误信息。
		echo $down->getError();
		exit();
	}
}
//直接下载文件的方式
foreach($files as $key=>$val){
	echo "通过单击右键->文件另存为下载文件：<a href='".$val[0]."'>".$val[0]."</a><br>";
}
//通过URL跳转下载文件的方法
foreach($files as $key=>$val){
	echo "通过单击链接下载文件：<a href='?action=download&fid=".$key."'>".$val[0]."</a><br>";
}
?>
