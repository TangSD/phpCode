<!-------------------------------------------文件名： 2_1.php-------------------------------->
<?php
/*************************设置变量************************************/
$varint    = 1;                 //设置一个名为$varint的整型变量
$varinteger = "4";              //设置一个名为$varinteger的字符串变量 
$varstring = "小李";      //设置一个名为$varstring的字符串变量
$varbool   = true;               //设置一个名为$varbool的布尔型变量
$varfloat  = 12.5;               //设置一个名为$varfloat的浮点型变量
$vardelete = "delete";//设置一个名为$varobject的字符串变量
/**
* 设置一个名为$varsarray的数组变量
* */
$varsarray = array(
	"1"=>"one",
	"2"=>"two"
);
//为数组添加一个新元素
$varsarray["3"] = "three";
/**
* 设置一个名为$vardarray的多维数组变量
* */
$vardarray = array(
	"cn"=>array("1"=>"一","2"=>"二"),
	"en"=>array("1"=>"one","2"=>"two")
);
//定义一个类
class testClass{
	var $_title = "这是对象类型的演示";
	function test(){
		echo $this->_title;
	}
}
//实例化类，取得对象类型变量
$newTest = new testClass();
//取得一个资源类型的变量
$fp = fopen("test.txt","w");
//定义一个NULL类型的变量
$varnull = NULL;
//删除一个变量
unset($vardelete);
//删除$varsarray数组中指定的元素
unset($varsarray["3"]);
?>