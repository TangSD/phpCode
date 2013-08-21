<!-------------------------------------------文件名： showuser.php-------------------------------->
<?php
//创建一个与文件中相同的类
class showuser{
	//创建构造函数
	function showuser(){}
	//创建默认函数
	function main($option){
		$u = explode(",",$option);
		echo "用户姓名：".$u[0]."，年龄：".$u[1];
	}
}
?>
