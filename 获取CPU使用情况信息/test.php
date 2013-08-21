<?php
//获取了内存使用情况，也可以使用PHP的getrusage()获取CPU使用情况，该方法在windows下不可用。 
print_r(getrusage());  
/* 输出 
Array 
( 
[ru_oublock] => 0 
[ru_inblock] => 0 
[ru_msgsnd] => 2 
[ru_msgrcv] => 3 
[ru_maxrss] => 12692 
[ru_ixrss] => 764 
[ru_idrss] => 3864 
[ru_minflt] => 94 
[ru_majflt] => 0 
[ru_nsignals] => 1 
[ru_nvcsw] => 67 
[ru_nivcsw] => 4 
[ru_nswap] => 0 
[ru_utime.tv_usec] => 0 
[ru_utime.tv_sec] => 0 
[ru_stime.tv_usec] => 6269 
[ru_stime.tv_sec] => 0 
) 

这个结构看上出很晦涩，除非你对CPU很了解。下面一些解释： 

ru_oublock: 块输出操作
ru_inblock: 块输入操作
ru_msgsnd: 发送的message
ru_msgrcv: 收到的message
ru_maxrss: 最大驻留集大小
ru_ixrss: 全部共享内存大小
ru_idrss:全部非共享内存大小
ru_minflt: 页回收
ru_majflt: 页失效
ru_nsignals: 收到的信号
ru_nvcsw: 主动上下文切换
ru_nivcsw: 被动上下文切换
ru_nswap: 交换区
ru_utime.tv_usec: 用户态时间 (microseconds)
ru_utime.tv_sec: 用户态时间(seconds)
ru_stime.tv_usec: 系统内核时间 (microseconds)
ru_stime.tv_sec: 系统内核时间?(seconds)
*/

//要看到你的脚本消耗了多少CPU，我们需要看看“用户态的时间”和“系统内核时间”的值。秒和微秒部分是分别提供的，您可以把微秒值除以100万，并把它添加到秒的值后，可以得到有小数部分的秒数。
// sleep for 3 seconds (non-busy)  
sleep(3);  
$data = getrusage();  
echo "User time: ".  
($data['ru_utime.tv_sec'] +  
$data['ru_utime.tv_usec'] / 1000000);  
echo "System time: ".  
($data['ru_stime.tv_sec'] +  
$data['ru_stime.tv_usec'] / 1000000);  
/* 输出 
User time: 0.011552 
System time: 0 
*/  

//sleep是不占用系统时间的，我们可以来看下面的一个例子： 
// loop 10 million times (busy)  
for($i=0;$i<10000000;$i++) {  
}  
$data = getrusage();  
echo "User time: ".  
($data['ru_utime.tv_sec'] +  
$data['ru_utime.tv_usec'] / 1000000);  
echo "System time: ".  
($data['ru_stime.tv_sec'] +  
$data['ru_stime.tv_usec'] / 1000000);  
/* 输出 
User time: 1.424592 
System time: 0.004204 
*/


//这花了大约14秒的CPU时间，几乎所有的都是用户的时间，因为没有系统调用。系统时间是CPU花费在系统调用上的上执行内核指令的时间。下面是一个例子：
$start = microtime(true);  
// keep calling microtime for about 3 seconds  
while(microtime(true) – $start < 3) {  
}  
$data = getrusage();  
echo "User time: ".  
($data['ru_utime.tv_sec'] +  
$data['ru_utime.tv_usec'] / 1000000);  
echo "System time: ".  
($data['ru_stime.tv_sec'] +  
$data['ru_stime.tv_usec'] / 1000000);  
/* prints 
User time: 1.088171 
System time: 1.675315 
*/


?>
