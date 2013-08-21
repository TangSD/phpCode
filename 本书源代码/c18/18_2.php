<?php
/** 
* 首先创建Client对象 
*/ 
$Options = array(
	'uri'=>'nameAPI',  //设置命名空间 
    'location'=>'http://localhost/examples/c18/18_1.php', //设置Server地址 
    'trace'=>true //开启SoapClient的Trace功能
);
//实例化SoapClient类
$SoapClient = new SoapClient(null,$Options); 
/** 
* 远程调用Web Service中的方法 
*/ 
try{ //使用try{}catch(){}捕获SOAP操作过程中的错误信息
   $return = $SoapClient->returnMax(8,9); 
}catch(Exception $e){ 
} 
echo $return;//输出返回的结果 
?>