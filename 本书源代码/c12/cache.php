<?php
class cache{
	//定义缓存文件的名称，默认为_index.htm
	var $_file;
	//定义缓存自动更新的时间，默认为1
	var $cache_time;
	//使用构造函数，初始化相关设置变量
	function cache($_file = '_index.htm', $cache_time = 1) {
		$this->_file = $_file;
		$this->cache_time = $cache_time;
	}
	//开始引用缓存文件或开启输出缓存
	function startCache() {
		//当缓存文件存在，并且有效时，包含缓存文件
		if ($this->cacheActive()) {
			include ($this->_file);
			exit();
		}
		ob_start();
	}

	//结束缓存输出，将缓存内容保存为HTML文件后，输出缓存内容
	function endCache(){
		//取得输出缓存中的内容
		$content = ob_get_contents();
		//使用buildFile()函数，保存生成的HTML页面
		if($this->buildFile($content)) {
			return true;
		} else {
			return false;
		}
		//使用ob_end_flush()函数，输出缓存内容
		ob_end_flush();
	}

	//检测缓存是否有效
	function cacheActive() {
		$lastmodified = @filemtime($this->_file);
		if(file_exists($this->_file)) {
			if (time() - $lastmodified < $this->cache_time){
				return true;
			} else {
				@unlink($this->_file);
				return false;
			}
		} else {
			return false;
		}
	}

	//根据参数，创建文件
	function buildFile($content, $mode = 'w+') {
		$this->makedir($this->_file);
		//写入缓存文件出错时，显示错误信息
		if (!$fp = @ fopen($this->_file, $mode)) {
			$this->alert($this->_file . " 目录或者文件属性无法写入.");
			return false;
		} else {
			@fwrite($fp, $content);
			@fclose($fp);
			return true;
		}
	}
	//根据文件路径创建目录
	function makedir() {
		$dir = @ explode("/", $this->_file);
		$num = @ count($dir) - 1;
		$tmp = './';
		for ($i = 0; $i < $num; $i++) {
			$tmp .= $dir[$i];
			if (!file_exists($tmp)) {
				@ mkdir($tmp);
				@ chmod($tmp, 0777);
			}
			$tmp .= '/';
		}
	}

	//清除已有缓存内容
	function clear_cache() {
		if (!@unlink($this->_file)) {
			$this->alert('删除缓存内容出错!');
			return false;
		} else {
			return true;
		}
	}
	//显示创建缓存中出现的错误
	function alert($message = NULL) {
		if ($message != NULL) {
			trigger_error($message);
		}
	}
}
?>

