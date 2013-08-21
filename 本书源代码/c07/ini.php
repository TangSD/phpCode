<?php
/**************************ini.php******************************/
//定义一个以ini命名的类
class ini{
	//定义存放INI配置文件的公共变量
	var $_ini = "";
	//创建INI文件主函数
	function create($data){
		$ini = "";
		//遍历数组
		foreach($data as $k=>$v){
			//根据数组第一维数据生成节名称
			$ini .= "[".$k."]\n\r";
			//遍历二维数据
			foreach($v as $kk=>$kv){
				//处理默认值
				if($kv=="no" or $kv==null or $kv==false){
					$value = "";
				}elseif($kv=="yes" or $kv==true){
					$value = 1;
				}else{
					$value = $kv;
				}
				//生成键与值对应的数据
				$ini .= $kk." = ".$kv."\n\r";
			}
		}
		$this->_ini = $ini;
	}
	//以字符的形式，取得生成后的INI文件内容
	function getContents(){
		print_r($this->_ini);
	}
	//以文件的形式，取得生成后的INI文件内容
	function getFile($name){
		$this->BuildFile($name,$this->_ini);
	}
	//用于创建文件的函数
	function BuildFile($getFile,$getContent,$access="w"){
		if(!$handle = fopen ($getFile,$access)){
			echo "ERROR:目录权限配置错误";
			exit();
		}
		if(!fwrite($handle,$getContent)){
			echo "ERROR:文件写入错误";
			exit();
		}
		fclose($handle);
	}
	function parse($name,$section=false){
		$this->_ini = parse_ini_file($name,$section);
	}
	function getIni(){
		return $this->_ini;
	}
}
?>