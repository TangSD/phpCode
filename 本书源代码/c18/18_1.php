<?php
if(isset($_GET["mode"]) and $_GET["mode"]=="wsdl"){
	//WSDL模式
	function returnMax($x,$y){ 
		if($x-$y>0){
			return $x;
		}else{
			return $y;
		}
	}	
	$SoapServer = new SoapServer('test.wsdl');
	$SoapServer->addFunction('returnMax');
	$SoapServer->handle();
}else{
	//non-WSDL模式
	//定义一个基础类
	class mis{ 
		public function returnMax($x,$y){ 
			if($x-$y>0){
				return $x;
			}else{
				return $y;
			}
		} 
	}
	/** 
	* 创建服务器对象 
	*/ 
	$Options = array('uri'=>'nameAPI');    //设置命名空间 
	$SoapServer = new SoapServer(null,$Options); 
	$SoapServer->setClass("mis"); //注册Basic类的所有方法 
	$SoapServer->handle(); //处理SOAP请求
}
?>