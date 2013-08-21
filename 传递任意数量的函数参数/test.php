<?php
// 两个默认参数的函数  
function foo($arg1 = ”, $arg2 = ”) {  
echo “arg1: $arg1\n”;  
echo “arg2: $arg2\n”;  
}  
foo('hello','world');  
/* 输出: 
arg1: hello 
arg2: world 
*/  
foo();  
/* 输出: 
arg1: 
arg2: 
*/  
下面这个示例是PHP的不定参数用法，其使用到了

/*[url=http://us2.php.net/manual/en/function.func-get-args.php]func_get_args()[/url]方法:*/


// 是的，形参列表为空  
function foo() {  
// 取得所有的传入参数的数组  
$args = func_get_args();  
foreach ($args as $k => $v) {  
echo “arg”.($k+1).”: $v\n”;  
}  
}  
foo();  
/* 什么也不会输出 */  
foo('hello');  
/* 输出 
arg1: hello 
*/  
foo('hello', 'world', 'again');  
/* 输出 
arg1: hello 
arg2: world 
arg3: again 
*/  
?>