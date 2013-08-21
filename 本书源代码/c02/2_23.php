<!-------------------------------------------文件名： 2_23.php-------------------------------->
<?php
//检查客户端提交的数据，确定是否需要调用其他类处理数据
if(isset($_POST["c"])){
	//根据客户端数据，确定要调用的类
	$c = $_POST["c"];
}else{
	//如果用户没有指定类，则默认调用showtable类
	$c = "showtable";
}
//检测客户端是否指定了方法来处理数据
if(isset($_POST["a"])){
	//根据客户端数据，调用指定的方法
	$a = $_POST["a"];
}else{
	//如果用户没有指定方法，则默认调用main()函数
	$a = "main";
}
//检查客户端是否提交了其他数据
if(isset($_POST["d"])){
	//如果客户端提交了数据，格式化数据
	$d = implode(",",$_POST["d"]);
}else{
	//如果客户端没有提交其他数据，设置为空
	$d = "";
}
//检测类文件是否存在
if(file_exists($c.".php")){
	//加载类文件
	include($c.".php");
	//检测类文件加载后，是否存在类
	if(class_exists($c)){
		//当类存在时，初始化类
		$e = new $c();
		//调用对象的方法
		$e->$a($d);
	}
}
?>

  <form action="2_23.php" method="post">

  姓名：<input type="text" name="d[name]" value=""/><br/>
  年龄：<input type="text" name="d[age]" value="" size="40" maxlength="40"/>
<br>
  <input type="hidden" name="c" value="showuser"/>
  <input type="submit" name="name" value="提交"/>
  </form>
