<?php
//当我们说到压缩，我们可能会想到文件压缩，其实，字符串也是可以压缩的。PHP提供了?gzcompress() 和gzuncompress() 函数：

$string =  
"Lorem ipsum dolor sit amet, consectetur  
adipiscing elit. Nunc ut elit id mi ultricies  
adipiscing. Nulla facilisi. Praesent pulvinar,  
sapien vel feugiat vestibulum, nulla dui pretium orci,  
non ultricies elit lacus quis ante. Lorem ipsum dolor  
sit amet, consectetur adipiscing elit. Aliquam  
pretium ullamcorper urna quis iaculis. Etiam ac massa  
sed turpis tempor luctus. Curabitur sed nibh eu elit  
mollis congue. Praesent ipsum diam, consectetur vitae  
ornare a, aliquam a nunc. In id magna pellentesque  
tellus posuere adipiscing. Sed non mi metus, at lacinia  
augue. Sed magna nisi, ornare in mollis in, mollis  
sed nunc. Etiam at justo in leo congue mollis.  
Nullam in neque eget metus hendrerit scelerisque  
eu non enim. Ut malesuada lacus eu nulla bibendum  
id euismod urna sodales. ";  
$compressed = gzcompress($string);  
echo "Original size: ". strlen($string)."\n";  
/* 输出原始大小 
Original size: 800 
*/  
echo "Compressed size: ". strlen($compressed)."\n";  
/* 输出压缩后的大小 
Compressed size: 418 
*/  
// 解压缩  
$original = gzuncompress($compressed);  
?>
