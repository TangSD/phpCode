<?php
//PHP的内存回收机制已经非常强大，你也可以使用PHP脚本获取当前内存的使用情况，调用memory_get_usage() 函数获取当期内存使用情况，调用memory_get_peak_usage() 函数获取内存使用的峰值。参考代码如下： 

echo "Initial: ".memory_get_usage()." bytes \n";  
/* 输出 
Initial: 361400 bytes 
*/  
// 使用内存  
for ($i = 0; $i < 100000; $i++) {  
$array []= md5($i);  
}  
// 删除一半的内存  
for ($i = 0; $i < 100000; $i++) {  
unset($array[$i]);  
}  
echo "Final: ".memory_get_usage()." bytes \n";  
/* prints 
Final: 885912 bytes 
*/  
echo "Peak: ".memory_get_peak_usage().' bytes \n';  
/* 输出峰值 
Peak: 13687072 bytes 
*/  
?>