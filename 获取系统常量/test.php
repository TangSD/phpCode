<?php
/*
PHP 提供非常有用的系统常量 可以让你得到当前的行号 (__LINE__)，文件 (__FILE__)，目录 (__DIR__)，函数名 (__FUNCTION__)，类名(__CLASS__)，方法名(__METHOD__) 和名字空间 (__NAMESPACE__)，很像C语言。 

我们可以以为这些东西主要是用于调试，当也不一定，比如我们可以在include其它文件的时候使用?__FILE__ (当然，你也可以在 PHP 5.3以后使用 __DIR__ )，下面是一个例子。
*/
// this is relative to the loaded script’s path  
// it may cause problems when running scripts from different directories  
require_once('config/database.php');  
// this is always relative to this file’s path  
// no matter where it was included from  
require_once(dirname(__FILE__) . '/config/database.php');  

//下面是使用 __LINE__ 来输出一些debug的信息，这样有助于你调试程序： 
// some code  
// …  
my_debug("some debug message", __LINE__);  
/* 输出 
Line 4: some debug message 
*/  
// some more code  
// …  
my_debug("another debug message", __LINE__);  
/* 输出 
Line 11: another debug message 
*/  
function my_debug($msg, $line) {  
echo "Line $line: $msg\n";  
}  

?>