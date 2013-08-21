<!-------------------------------------------文件名： 2_2.php-------------------------------->
<?php
/*************************设置变量************************************/
$varint    = 1;                 //设置一个名为$varint的整型变量
$varinteger = "4";              //设置一个名为$varinteger的字符串变量 
$varstring = "小明";      //设置一个名为$varstring的字符串变量
$varbool   = true;               //设置一个名为$varbool的布尔型变量
$varfloat  = 12.5;               //设置一个名为$varfloat的浮点型变量
$varobject = "will be an object";//设置一个名为$varobject的字符串变量
$show_1    = "show_2";
$$show_1    = true;
$show_3    = NULL;
/**
* 设置一个名为$varsarray的数组变量
* */
$varsarray = array(
	"1"=>"one",
	"2"=>"two"
);
/**
* 设置一个名为$vardarray的多维数组变量
* */
$vardarray = array(
	"cn"=>array("1"=>"一","2"=>"二"),
	"en"=>array("1"=>"one","2"=>"two")
);
echo "使用gettype()函数，查看变量转换前的类型<br>";
echo gettype($varobject)."<br>";
echo gettype($varinteger)."<br>";
echo gettype($varsarray)."<br>";
echo gettype($varint)."<br>";
echo gettype($vardarray)."<br>";
echo gettype($show_3)."<br>";
/*************************变量类型转换************************************/
settype($varobject,"object");         //使用settype()函数，把$varobject的类型转换为对象类型
$varinteger     = (int)$varinteger;   //强制转换类型，把$varinteger的类型转换为整型
$varsarray      = (object)$varsarray; //强制类型转换，把$varsarray转换为对象类型
$varint  = "$varint";          //根据字符串定义的方法，把$varint转换为字符串型
$vardarray        = (int)$vardarray;    //强制类型转换，把$vardarray转换为整型
/*************************可变变量用于变量类型转换************************************/
$show_3 = $$show_1;
/*************************查看变量类型************************************/
echo "<br>使用gettype()函数，查看变量转换后的类型<br>";
echo gettype($varobject)."<br>";
echo gettype($varinteger)."<br>";
echo gettype($varsarray)."<br>";
echo gettype($varint)."<br>";
echo gettype($vardarray)."<br>";
echo gettype($show_3);
?>