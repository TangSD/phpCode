<!-------------------------------------------文件名： 2_12.php-------------------------------->
<?php
//使用define()函数定义常量
define("_STRING","两数相乘等于：");
define("_INTEGER",12);
define("_FLOAT",12.3);
define("_BOOLEAN",true);
define("BOY_AGE",18);
define("GIRL_AGE",17);
//在程序中使用常量
if(_BOOLEAN == true){
	echo _STRING._INTEGER*_FLOAT."<br>";
}
echo "男孩今年".BOY_AGE."岁，女孩今年".GIRL_AGE."岁。<br>"
?>
