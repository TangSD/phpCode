<?php
/******************************9_1.php*********************************/
//创建mark类
class mark{
	//定义公用变量
	var $_type = "";
	var $_font = "";
	var $_fontColor  = "";
	var $_fontSize   = "";
	var $_target   = "";
	function domark( $sourceFile ,$SaveImage){
		//使用watermark()函数，添加水印
		$image = $this->Watermark($sourceFile);
		//输出JPEG格式的图片
		ImageJpeg($image,$SaveImage);
		imageDestroy($image);
	}
	//创建构造函数，初始化类相关变量，并调用Watermark()函数，为指定的图片添加水印
	function mark($type, $Font, $color, $fontSize, $target){
		//设置水印类型
		$this->_type = $type;
		//设置水印文字使用的字体
		$this->_font = $Font;
		//设置水印字使用的颜色
		$this->_fontColor = $color;
		$this->_fontSize = $fontSize;
		//设置坐标位置
		$this->_target = $target;
	}
	//用于重新设置参数的setMark函数
	function setMark($type, $Font, $color, $fontSize, $target){
		//设置水印类型
		$this->_type = $type;
		//设置水印文字使用的字体
		$this->_font = $Font;
		//设置水印字使用的颜色
		$this->_fontColor = $color;
		$this->_fontSize = $fontSize;
		//设置坐标位置
		$this->_target = $target;
	}
	//添加水印主函数
	function WaterMark($Source) {
		//根据$source的类型，判读添加水印文字，还是水印图片
		if(is_string($Source)) {
			$image = $this->getImageType($Source);
		}else{
			$image = $Source;
		}
		//取得图像的宽度
		$W = imageSX($image);
		//取得图像的高度
		$H = imageSY($image);
		//如果没有设置水印文字或图标时，通出程序
		if(strlen(Trim($this->_type)) == 0) {
			die("还没有设置水印文字或图标！");
			exit();
		}
		//如果水印图标文件存时，获取水印图片的宽和高
		if (file_exists($this->_type)) {
			$waterIm = $this->getImageType($this->_type);
			$waterWidth = imageSX($waterIm);
			$waterHeight = imageSY($waterIm);
		}else{
			//为水印文字进行转码
			$WaterText = iconv('gb2312', 'utf-8', $this->_type);
			//设置水印文字的字体和大小
			$info = (!file_exists($this->_font)) ? ImageTTFBBox($this->_fontSize, 0, "ARIAL.TTF", $WaterText) : ImageTTFBBox($this->_fontSize, 0, $this->_font, $WaterText);
			$waterWidth = $info[4] - $info[6];
			$waterHeight = $info[1] - $info[7];
			unset($info);
		}
		//根据用户设置的数据，决定水印的位置
		switch($this->_target){
			case 0 :
				$X = rand(10, ($W - $waterWidth) -10);
				$Y = rand(10, ($H - $waterHeight) -10);
				break;
			case 1 :
				$X = 10;
				$Y = 0;
				break;
			case 2 :
				$X = ($W - $waterWidth) / 2;
				$Y = 0;
				break;
			case 3 :
				$X = $W - $waterWidth -10;
				$Y = 0;
				break;
			case 4 :
				$X = 10;
				$Y = ($H - $waterHeight) / 2;
				break;
			case 5 :
				$X = ($W - $waterWidth) / 2;
				$Y = ($H - $waterHeight) / 2;
				break;
			case 6 :
				$X = $W - $waterWidth -10;
				$Y = ($H - $waterHeight) / 2;
				break;
			case 7 :
				$X = 10;
				$Y = $H - $waterHeight -10;
				break;
			case 8 :
				$X = ($W - $waterWidth) / 2;
				$Y = $H - $waterHeight -10;
				break;
			case 9 :
				$X = $W - $waterWidth -10;
				$Y = $H - $waterHeight -10;
				break;
			default :
				$X = rand(10, ($W - $waterWidth) -10);
				$Y = rand(10, ($H - $waterHeight) -10);
				break;
		}
		//开启混色模式
		imageAlphaBlending($image, true);
		//如果水印图片存在，定位水印图标的位置，位合并两个图片
		if (file_exists($this->_type)) {
			$X == 10 ? $X = 0 : $X == $W - $waterWidth -10 ? $X = $X +10 : $X;
			$Y == $H - $waterHeight -10 ? $Y = $Y +10 : $Y;
			imagecopymerge($image, $waterIm, $X, $Y, 0, 0, $waterWidth, $waterHeight, 100);
		} else {
			//如果设置水印文字，设置字体的颜色
			if (!Empty ($this->_fontColor) && strlen($this->_fontColor) == 7) {
				$bjRGB = imagecolorallocate($image, Hexdec(substr($this->_fontColor, 1, 2)), Hexdec(substr($this->_fontColor, 3, 2)), Hexdec(substr($this->_fontColor, 5)));
				file_exists($this->_font) ? imagettftext($image, $this->_fontSize, 0, $X, $Y + $waterHeight, $bjRGB, $this->_font, $WaterText) : imageTtfText($image, $this->_fontSize, 0, $X, $Y + $waterHeight, $bjRGB, "ARIAL.TTF", $WaterText);
			} else {
				die("文字颜色格式错误！");
			}
		}
		//删除已经设置的相关变量
		if (isset($WaterText)){unset($WaterText);}
		if (isset($waterWidth)){unset($waterWidth);}
		if (isset($waterHeight)){unset($waterHeight);}
		if (isset($W)){unset($W);}
		if (isset($H)){unset($H);}
		if (isset($X)){unset($X);}
		if (isset($bjRGB)){unset($bjRGB);}
		if (isset($waterIm)){imageDestroy($waterIm);}
		return($image);
	}
	//根据文件，返回一个根据对应格式生成的图像。
	function getImageType($file) {
		//使用getimagesize()函数，返回图像相关数据
		file_exists($file) ? $TempImage = getimagesize($file) : die("getImageType:函数参数不正确！");
		switch ($TempImage[2]) {
			case 1 :
				$image = imageCreateFromGif($file);
				break;
			case 2 :
				$image = imageCreateFromJpeg($file);
				break;
			case 3 :
				$image = imageCreateFromPng($file);
				break;
			default :
				die("不支持该文件格式,请使用GIF、JPG、PNG格式。");
		}
		unset($TempImage);
		return ($image);
	}
}
$mark = new mark("icon.jpg","simhei.ttf","#00cccc",25,2);
$mark->domark("base.jpg","water.jpg");
echo "<img src='water.jpg'>";
$mark->setMark("水印文字演示","simhei.ttf","#00cccc",25,5);
$mark->domark("base.jpg","text.jpg");
echo "<img src='text.jpg'>";
?>