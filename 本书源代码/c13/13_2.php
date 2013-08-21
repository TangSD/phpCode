<?php
/***********************13_2.php********************************/
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
  		<!--构造函数可以接收的第一类参数-->
  		$("div > p").css("border", "1px solid gray");
  		jQuery("ul > li").css("border", "1px solid gray");
  		<!--构造函数可以接收的第二类参数-->
  		$("<div><p>动态添加的内容</p></div>").appendTo("body");
  		$("<input type='checkbox'/>").appendTo("body");
  		$("<input type='button' value='动态添加的按钮'/>").appendTo("body");
  		$("<textarea></textarea>").appendTo("body");
  		<!--构造函数可以接收的第三类参数-->
  		$(document.body).css( "background", "efefef" );
  	});
  </script>
 </head>
 <body>
 <div><p>动态添加样式</p></div>
 <ul><li>第一条记录</li></ul>
 </body>
</html>