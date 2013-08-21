<?php
class upLoad {
	private $_thumb_width = 100;
	private $_thumb_height = 100;
	function uploadFile($fileField,$userid,$oldPath="") {
		//缩略图宽度
		$RESIZEWIDTH = $this->_thumb_width;
		//缩略图高度 
		$RESIZEHEIGHT = $this->_thumb_height;
		$upfile = "";
		//获取$_FILES变量中的数据
		$files = $_FILES [$fileField];
		//获取文件名
		$fileName = $files ['name'];
		//获取文件类型
		$fileType = $files ['type'];
		//获取临时文件的文件名
		$fileTemp = $files ['tmp_name'];
		if($fileName != "" and $fileTemp != "" and $fileType != ""){
			if($this->allowType($fileType)){
				//获取文件大小
				$upfile["filesize"] = filesize($fileTemp);
				//创建文件夹，将上传的文件保存到新创建的文件夹中
				if($oldPath==""){
					$filePath = $this->createDir($userid);
				}else{
					$filePath = $oldPath;	
				}				
				//获取文件扩展名
				$fileExtendedName = $this->getExtendedName ( $fileName ); 
				//设置新的文件名称，以保证上传的文件不重名
				$newFileName = time (). "." . $fileExtendedName;
				//使用move_uploaded_file()函数，上传的临时文件，保存到服务器指定的路径中，并返回状态
				$upfile["filename"]= $newFileName;
				$upfile["filetype"]= $fileType;
				$upfile["filestat"] = @move_uploaded_file ( $fileTemp, $filePath . $newFileName ) ? "true":"false";
				switch($fileType){
					case "image/pjpeg":
						$im = imagecreatefromjpeg ( $filePath.$newFileName );
					break;
					case "image/x-png":
						$im = imagecreatefrompng ( $filePath.$newFileName );
					break;
					case "image/gif":
						$im = imagecreatefromgif ( $filePath.$newFileName );
					break;
				}
				$this->thumbnail( $im, $RESIZEWIDTH, $RESIZEHEIGHT,  $filePath."/thumbnail/".$newFileName );
				ImageDestroy ( $im );
			}else{
				$upfile["filename"]= "非法的文件类型。";
				$upfile["filestat"] = "false";
			}
		}else{
			$upfile["filename"]= "无效的文件数据。";
			$upfile["filestat"] = "false";
		}
		return $upfile;
	}
	//上传多个文件
	function multiUpload($fileField,$userid,$oldPath="") {
		//缩略图宽度
		$RESIZEWIDTH = $this->_thumb_width;
		//缩略图高度 
		$RESIZEHEIGHT = $this->_thumb_height;
		$upfiles = "";
		//获取$_FILES变量中的数据
		$files = $_FILES [$fileField];
		//获取上传文件的文件名
		$fileName = $files ['name'];
		//获取临时文件的文件名
		$fileTemp = $files ['tmp_name'];
		//获取文件类型
		$fileType = $files ['type'];
		//创建用于保存文件的文件夹
		if($oldPath==""){
			$filePath = $this->createDir($userid);
		}else{
			$filePath = $oldPath;	
		}	
		//遍历上传的文件内容
		for($i = 0; $i < count ( $fileName ); $i ++) {
			//如果文件名与临时文件都不为空，则上传文件
			if ($fileName [$i] != "" and $fileTemp [$i] != "" and $fileType[$i]!="" ) {
				if($this->allowType($fileType[$i])){
					//设置新文件名称
					$newFileName = time () . $i;
					$fileExtendedName = $this->getExtendedName ( $fileName [$i] ); //设置文件类别
					$newFilePathAndName = $newFileName . "." . $fileExtendedName;
					$upfiles["filesize"][$i] = filesize($fileTemp[$i]);
					$upfiles["filename"][$i] = $newFilePathAndName;
					$upfiles["filetype"][$i] = $fileType[$i];
					$upfiles["filestat"][$i] = @move_uploaded_file ( $fileTemp [$i], $filePath.$newFilePathAndName ) ? "true" : "false";
					switch($fileType[$i]){
						case "image/pjpeg":
							$im = imagecreatefromjpeg ( $filePath.$newFilePathAndName );
						break;
						case "image/x-png":
							$im = imagecreatefrompng ( $filePath.$newFilePathAndName );
						break;
						case "image/gif":
							$im = imagecreatefromgif ( $filePath.$newFilePathAndName );
						break;
					}
					$this->thumbnail( $im, $RESIZEWIDTH, $RESIZEHEIGHT,  $filePath."/thumbnail/".$newFilePathAndName);
					ImageDestroy ( $im );
				}else{
					$upfiles["filename"][$i] = "非法的文件类型。";
					$upfiles["filestat"][$i] = "false";
				}
			}else{
				$upfiles["filename"][$i] = "无效的文件数据。";
				$upfiles["filestat"][$i] = "false";	
			}
		}
		return $upfiles;
	}
	/**
	 * 取得文件名后缀
	 */
	function getExtendedName($fileName) {
		return end ( explode ( '.', $fileName ) );
	}
	/**
	 * 检查是非为允许上传的文件类型
	 */
	function allowType($type) {
		//设置不允许上传文件类型数组
		$types = array ('application/x-js', 'application/octet-stream','application/x-php','text/html' );
		if (in_array ( $type, $types )) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	/**
	 * 建立目录 目录格式  用户ID/年/月/日/
	 */
	function createDir($userid) {
		$root = 'folder';
		$pathSign = DIRECTORY_SEPARATOR;
		$u = $userid . $pathSign;
		$y = date ( 'Y' ) . $pathSign;
		$m = date ( 'm' ) . $pathSign;
		$d = date ( 'd' ) ;
		$realpath = $root . $pathSign . $u . $y . $m . $d;
		$path = $root . $pathSign . $u . $y . $m . $d .$pathSign."thumbnail";
		$dirArray = explode ( $pathSign, $path );
		$tempDir = '';
		foreach ( $dirArray as $dir ) {
			$tempDir .= $dir . $pathSign;
			$isFile = file_exists ( $tempDir );
			clearstatcache ();
			if (! $isFile && ! is_dir ( $tempDir )) {
				@mkdir ( $tempDir, 0777 );
			}
		}
		return $realpath . $pathSign;
	}
	//创建JPG格式的缩略图
	function thumbnail($im, $maxwidth, $maxheight, $name) {
		$width = imagesx ( $im );
		$height = imagesy ( $im );
		if (($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)) {
			if ($maxwidth && $width > $maxwidth) {
				$widthratio = $maxwidth / $width;
				$RESIZEWIDTH = true;
			}
			if ($maxheight && $height > $maxheight) {
				$heightratio = $maxheight / $height;
				$RESIZEHEIGHT = true;
			}
			if ($RESIZEWIDTH && $RESIZEHEIGHT) {
				if ($widthratio < $heightratio) {
					$ratio = $widthratio;
				} else {
					$ratio = $heightratio;
				}
			} elseif ($RESIZEWIDTH) {
				$ratio = $widthratio;
			} elseif ($RESIZEHEIGHT) {
				$ratio = $heightratio;
			}
			$newwidth = $width * $ratio;
			$newheight = $height * $ratio;
			if (function_exists ( "imagecopyresampled" )) {
				$newim = imagecreatetruecolor ( $newwidth, $newheight );
				imagecopyresampled ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
			} else {
				$newim = imagecreate ( $newwidth, $newheight );
				imagecopyresized ( $newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
			}
			ImageJpeg ( $newim, $name . ".jpg" );
			ImageDestroy ( $newim );
		} else {
			ImageJpeg ( $im, $name . ".jpg" );
		}
	}
}
?>
