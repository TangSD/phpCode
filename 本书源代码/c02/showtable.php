<!-------------------------------------------文件名： showtable.php-------------------------------->
<?php
//定义一个与文件名相同的类
class showtable{
	//创建构造函数，用于初始化类
	function showuser(){}
	//创建主函数，默认运行此函数
	function main(){
		echo "<table border='1'><tr><td>显示表格</td></tr></table>";
	}
	//创建其他函数
	function other(){
		echo "这是showtable类中函数other()";
	}
}
?>
