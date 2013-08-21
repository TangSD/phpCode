<?
/** 
 * 获取图象信息的类
 */
class exif{
	/**
	*显示文件Exif内容
	* */
	function exifshow($postimage){
		//创建用于保存表格内容的变量
		$innerhtml = "";
		//使用GetImageInfo()方法获取包括图片EXIF信息的数组
		$exif = $this->GetImageInfo($postimage);
		//开始构建表格
		$innerhtml .= "<TABLE id='exif'>";		
		foreach ( $exif as $name => $val ) {
			$innerhtml .= "<TR><TD>".$name."</TD><TD>".$val."</TD></TR>";
		}
		//显示缩略图		
		$innerhtml .= "<TR><TD colspan=\"2\">";
		//使用exif_thumbnail()函数获取图片中的缩略图数据
		$image = exif_thumbnail($postimage);
		if($image === false) {
			$innerhtml .= "没有可用的缩略图";
		} else {
			//当缩略图数据存在时，使用
			$innerhtml .= "<img src=\"thumbnail.php?image=".$postimage."\">";
		}		
		$innerhtml .= "</TD></TR></TABLE>";
		echo $innerhtml;
	}
	/***
	*根据键名取得数组的值 
	* */
	function GetImageInfoValue($ImageInfo, $val_array) {
		$InfoValue = "未知";
		//遍历数组
		foreach ( $val_array as $name => $val ) {
			//如果数组的值与指定的值相同，返回这个值，并结束遍历
			if ($name == $ImageInfo) {
				$InfoValue = &$val;
				break;
			}
		}
		//返回结果
		return $InfoValue;
	}
	/**
	*读取图片文件信息并转化为数组
	* */
	function GetImageInfo($img){
		//创建图片文件类型数组		
		$imgtype = array ("", "GIF", "JPG", "PNG", "SWF", "PSD", "BMP", "TIFF(intel byte order)", "TIFF(motorola byte order)", "JPC", "JP2", "JPX", "JB2", "SWC", "IFF", "WBMP", "XBM" );
		//创建定位数组
		$Orientation = array ("", "top left side", "top right side", "bottom right side", "bottom left side", "left side top", "right side top", "right side bottom", "left side bottom" );
		//创建长度单位数组
		$ResolutionUnit = array ("", "", "英寸", "厘米" );
		//黄色和洋红配置数组
		$YCbCrPositioning = array ("", "the center of pixel array", "the datum point" );
		//爆光模式数组
		$ExposureProgram = array ("未定义", "手动", "标准程序", "光圈先决", "快门先决", "景深先决", "运动模式", "肖像模式", "风景模式" );
		//测量模式数组
		$MeteringMode_arr = array ("0" => "未知", "1" => "平均", "2" => "中央重点平均测光", "3" => "点测", "4" => "分区", "5" => "评估", "6" => "局部", "255" => "其他" );
		//光源数组
		$Lightsource_arr = array ("0" => "未知", "1" => "日光", "2" => "荧光灯", "3" => "钨丝灯", "10" => "闪光灯", "17" => "标准灯光A", "18" => "标准灯光B", "19" => "标准灯光C", "20" => "D55", "21" => "D65", "22" => "D75", "255" => "其他" );
		//闪光灯频闪数组
		$Flash_arr = array ("0" => "flash did not fire", "1" => "flash fired", "5" => "flash fired but strobe return light not detected", "7" => "flash fired and strobe return light detected" );
		//使用exif_read_data()函数读取图片的所有IFODO的标记数据
		$exif = exif_read_data ( $img, "IFD0" );
		//当返回值为false时，设置返回数组的的文件信息为没有图片EXIF信息。
		if($exif === false) {
			$new_img_info = array ("文件信息" => "没有图片EXIF信息" );
		} else {
			//成功返回值后，设置返回数组的文件信息数组内容
			$exif = exif_read_data ( $img, 0, true );
			$new_img_info = array (
				"文件信息" => "-----------------------------", 
				"文件名" => $exif ['FILE'] ['FileName'], 
				"文件类型" => $imgtype [$exif ['FILE'] ['FileType']], 
				"文件格式" => $exif ['FILE'] ['MimeType'], 
				"文件大小" => $exif ['FILE'] ['FileSize'], 
				"时间戳" => date ( "Y-m-d H:i:s", $exif ['FILE'] ['FileDateTime'] ), 
				"图像信息" => "-----------------------------", 
				"图片说明" => $exif ['IFD0'] ['ImageDescription'], 
				"制造商" => $exif ['IFD0'] ['Make'], 
				"型号" => $exif ['IFD0'] ['Model'], 
				"方向" => $Orientation [$exif ['IFD0'] ['Orientation']], 
				"水平分辨率" => $exif ['IFD0'] ['XResolution'] . $ResolutionUnit [$exif ['IFD0'] ['ResolutionUnit']], 
				"垂直分辨率" => $exif ['IFD0'] ['YResolution'] . $ResolutionUnit [$exif ['IFD0'] ['ResolutionUnit']], 
				"创建软件" => $exif ['IFD0'] ['Software'], 
				"修改时间" => $exif ['IFD0'] ['DateTime'], 
				"作者" => $exif ['IFD0'] ['Artist'], 
				"YCbCr位置控制" => $YCbCrPositioning [$exif ['IFD0'] ['YCbCrPositioning']], 
				"版权" => $exif ['IFD0'] ['Copyright'], 
				"摄影版权" => $exif ['COMPUTED'] ['Copyright.Photographer'], 
				"编辑版权" => $exif ['COMPUTED'] ['Copyright.Editor'], 
				"拍摄信息" => "-----------------------------", 
				"Exif版本" => $exif ['EXIF'] ['ExifVersion'], 
				"FlashPix版本" => "Ver. " . number_format ( $exif ['EXIF'] ['FlashPixVersion'] / 100, 2 ), 
				"拍摄时间" => $exif ['EXIF'] ['DateTimeOriginal'], 
				"数字化时间" => $exif ['EXIF'] ['DateTimeDigitized'], 
				"拍摄分辨率高" => $exif ['COMPUTED'] ['Height'], 
				"拍摄分辨率宽" => $exif ['COMPUTED'] ['Width'], 
				"光圈" => $exif ['EXIF'] ['ApertureValue'], 
				"快门速度" => $exif ['EXIF'] ['ShutterSpeedValue'], 
				"快门光圈" => $exif ['COMPUTED'] ['ApertureFNumber'], 
				"最大光圈值" => "F" . $exif ['EXIF'] ['MaxApertureValue'], 
				"曝光时间" => $exif ['EXIF'] ['ExposureTime'], 
				"F-Number" => $exif ['EXIF'] ['FNumber'], 
				"测光模式" => $this->GetImageInfoValue ( $exif ['EXIF'] ['MeteringMode'], $MeteringMode_arr ), 
				"光源" => $this->GetImageInfoValue ( $exif ['EXIF'] ['LightSource'], $Lightsource_arr ), 
				"闪光灯" => $this->GetImageInfoValue ( $exif ['EXIF'] ['Flash'], $Flash_arr ), 
				"曝光模式" => ($exif ['EXIF'] ['ExposureMode'] == 1 ? "手动" : "自动"), 
				"白平衡" => ($exif ['EXIF'] ['WhiteBalance'] == 1 ? "手动" : "自动"), 
				"曝光程序" => $ExposureProgram [$exif ['EXIF'] ['ExposureProgram']], 
				"曝光补偿" => $exif ['EXIF'] ['ExposureBiasValue'] . "EV", 
				"ISO感光度" => $exif ['EXIF'] ['ISOSpeedRatings'], 
				"分量配置" => (bin2hex ( $exif ['EXIF'] ['ComponentsConfiguration'] ) == "01020300" ? "YCbCr" : "RGB"),  
				"图像压缩率" => $exif ['EXIF'] ['CompressedBitsPerPixel'] . "Bits/Pixel", 
				"对焦距离" => $exif ['COMPUTED'] ['FocusDistance'] . "m", 
				"焦距" => $exif ['EXIF'] ['FocalLength'] . "mm", 
				"等价35mm焦距" => $exif ['EXIF'] ['FocalLengthIn35mmFilm'] . "mm", 
				"用户注释编码" => $exif ['COMPUTED'] ['UserCommentEncoding'], 
				"用户注释" => $exif ['COMPUTED'] ['UserComment'], 
				"色彩空间" => ($exif ['EXIF'] ['ColorSpace'] == 1 ? "sRGB" : "Uncalibrated"), 
				"Exif图像宽度" => $exif ['EXIF'] ['ExifImageLength'], 
				"Exif图像高度" => $exif ['EXIF'] ['ExifImageWidth'], 
				"文件来源" => (bin2hex ( $exif ['EXIF'] ['FileSource'] ) == 0x03 ? "digital still camera" : "unknown"), 
				"场景类型" => (bin2hex ( $exif ['EXIF'] ['SceneType'] ) == 0x01 ? "A directly photographed image" : "unknown"), 
				"缩略图文件格式" => $exif ['COMPUTED'] ['Thumbnail.FileType'], 
				"缩略图Mime格式" => $exif ['COMPUTED'] ['Thumbnail.MimeType']
			);
		}
		//返回文件EXIF信息数组
		return $new_img_info;
	}
}
?> 