<?php
//PHP序列化功能大家可能用的比较多，也比较常见，当你需要把数据存到数据库或者文件中是，你可以利用PHP中的serialize() 和 unserialize()方法来实现序列化和反序列化，代码如下： 

// 一个复杂的数组  
$myvar = array(  
'hello',  
42,  
array(1,'two'),  
'apple'  
);  
// 序列化  
$string = serialize($myvar);  
echo $string;  
/* 输出 
a:4:{i:0;s:5:"hello";i:1;i:42;i:2;a:2:{i:0;i:1;i:1;s:3:"two";}i:3;s:5:"apple';} 
*/  
// 反序例化  
$newvar = unserialize($string);  
print_r($newvar);  
/* 输出 
Array 
( 
[0] => hello 
[1] => 42 
[2] => Array 
( 
[0] => 1 
[1] => two 
) 
[3] => apple 
) 
*/

//如何序列化成json格式呢，放心，php也已经为你做好了，使用php 5.2以上版本的用户可以使用json_encode() 和 json_decode() 函数来实现json格式的序列化，代码如下： 
// a complex array  
$myvar = array(  
'hello',  
42,  
array(1,'two'),  
'apple'  
);  
// convert to a string  
$string = json_encode($myvar);  
echo $string;  
/* prints 
["hello",42,[1,"two"],"apple"] 
*/  
// you can reproduce the original variable  
$newvar = json_decode($string);  
print_r($newvar);  
/* prints 
Array 
( 
[0] => hello 
[1] => 42 
[2] => Array 
( 
[0] => 1 
[1] => two 
) 
[3] => apple 
) 
*/  


?>