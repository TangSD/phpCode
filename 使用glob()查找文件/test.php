<?php
//大部分PHP函数的函数名从字面上都可以理解其用途，但是当你看到?glob() 的时候，你也许并不知道这是用来做什么的，其实glob()和scandir() 一样，可以用来查找文件，请看下面的用法： 

// 取得所有的后缀为PHP的文件  
$files = glob('*.php');  
print_r($files);  
/* 输出: 
Array 
( 
[0] => phptest.php 
[1] => pi.php 
[2] => post_output.php 
[3] => test.php 
) 
*/

//你还可以查找多种后缀名： 
// 取PHP文件和TXT文件  
$files = glob('*.{php,txt}', GLOB_BRACE);  
print_r($files);  
/* 输出: 
Array 
( 
[0] => phptest.php 
[1] => pi.php 
[2] => post_output.php 
[3] => test.php 
[4] => log.txt 
[5] => test.txt 
) 
*/

//你还可以加上路径：
$files = glob(‘../images/a*.jpg’);  
print_r($files);  
/* 输出: 
Array 
( 
[0] => ../images/apple.jpg 
[1] => ../images/art.jpg 
) 
*/

//如果你想得到绝对路径，你可以调用?realpath() 函数：
$files = glob('../images/a*.jpg');  
// applies the function to each array element  
$files = array_map('realpath',$files);  
print_r($files);  
/* output looks like: 
Array 
( 
[0] => C:\wamp\www\images\apple.jpg 
[1] => C:\wamp\www\images\art.jpg 
) 
*/  

?>