<?php
/***********************13_3.php********************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
 <head>
  <title>jQuery演示</title>
  <!--引用jQuery代码-->
  <script language="javascript" type="text/javascript" src="js/jquery-1.2.6.js"></script>
  <!--创建javascript代码-->
  <script language="javascript" type="text/javascript">
  <!--构造函数可以接收的第四类参数：回调函数-->
  	$(function(){
  		<!--使用ID选择页面元素-->
  		$("#Layer1").css("border","3px solid red");
  		$("#Layer1").find("li").css("border","3px solid black");
  		$("#Layer2").css("border","3px solid black");
  		$("#Layer2 > li").css("border","3px solid red");
  		<!--使用元素名称选择页面元素-->
  		$("p").css("border","3px solid blue");
  		<!--使用CSS表达式选择页面元素-->
  		$(".Layer3").css("border","3px solid gray");
  		<!--同时选择不同类型的元素-->
  		$("span,.div4,#div5,div > p").css("border","3px solid yellow");
  	});
  </script>
  <style type="text/css">
<!--
#Layer1 {
	position:absolute;
	left:17px;
	top:220px;
	width:100px;
	height:100px;
	z-index:1;
}
#Layer2 {
	position:absolute;
	left:133px;
	top:220px;
	width:100px;
	height:100px;
	z-index:2;
}
.Layer3 {
	position:absolute;
	left:248px;
	top:220px;
	width:100px;
	height:100px;
	z-index:3;
}
-->
  </style>
</head>
 <body>
 <div id="Layer1">第一层<li>第一行</li><li>第二行</li></div>
 <div id="Layer2">第二层<li>第一行</li><li>第二行</li></div>
 <div class="Layer3">第三层</div>
 <p id=p1>行1</p><p id=p2>行2</p>
 <span>第三层</span>
 <div class="div4">第四层</div>
 <div id="div5">第五层</div>
 <div><p>第六层</p></div>
 </body>
</html>