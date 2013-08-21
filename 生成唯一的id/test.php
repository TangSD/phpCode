<?php
//很多朋友都利用md5()来生成唯一的编号，但是md5()有几个缺点：1、无序，导致数据库中排序性能下降。2、太长，需要更多的存储空间。其实PHP中自带一个函数来生成唯一的id，这个函数就是uniqid()。下面是用法：

// generate unique string  
echo uniqid();  
/* 输出 
4bd67c947233e 
*/  
// generate another unique string  
echo uniqid();  
/* 输出 
4bd67c9472340 
*/  

//该算法是根据CPU时间戳来生成的，所以在相近的时间段内，id前几位是一样的，这也方便id的排序，如果你想更好的避免重复，可以在id前加上前缀，如： 

// 前缀  
echo uniqid('foo_');  
/* 输出 
foo_4bd67d6cd8b8f 
*/  
// 有更多的
echo uniqid('',true);  
/* 输出 
4bd67d6cd8b926.12135106 
*/  
// 都有  
echo uniqid('bar_',true);  
/* 输出 
bar_4bd67da367b650.43684647 
*/  

?>