<?php
/*************************设置变量************************************/
$varint    = 55;                 //设置一个名为$varint的整型变量
$varinteger = "4";              //设置一个名为$varinteger的字符串变量 
$varstring = "小玲";      //设置一个名为$varstring的字符串变量
$varbool   = true;               //设置一个名为$varbool的布尔型变量
$varfloat  = 160.88;               //设置一个名为$varfloat的浮点型变量
$varobject = "will be an object";//设置一个名为$varobject的字符串变量
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
/*************************使用变量************************************/
//使用布尔值作为条件
if($varbool == true){
	//在同一行代码中，使用字符、整型和浮点型变量
	echo $varstring."的身高是：{$varfloat}厘米<br>";
}
echo $varint*$varfloat;
echo "<br>";
//遍历数组
foreach($varsarray as $a){
	echo $a."<br>";
}
//在同一行代码中，使用数组变量
echo "中文的1、2是".$vardarray["cn"]["1"]."、".$vardarray["cn"]["2"]."<br>";
echo '英文的1、2是'.$vardarray['en']['1'].'、'.$vardarray['en']['2'].'<br>';
?>