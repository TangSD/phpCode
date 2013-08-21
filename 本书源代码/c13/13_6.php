<?php
/***********************13_6.php********************************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
 <head>
  <title>jQuery演示</title>
  <!--引用jQuery代码-->
  <script language="javascript" type="text/javascript" src="js/jquery-1.2.6.js"></script>
  <!--创建javascript代码-->
    <script type="text/javascript">
        $(function(){
            //添加页面元素
            $('<input type=button><br><input type=text><br><div><div>').appendTo($('body'));
            //设置内容、属性
            $('input:button')
            	.val("按钮")
            	//绑定单击事件
            	.bind("click",function(){
            		//显示当前元素的value属性的值
            		alert($('input:button').val());
            		//移除div元素的类
            		 $('div').removeClass("panel");
            	});
            $('input:text')
            	//设置当前元素value属性的值为 文本框
            	.attr("value","文本框")
            	//绑定单击事件
            	.bind("click",function(){
            		//显示当前元素value属性的值
            		alert($('input:text').attr("value"));
            	});
            $('div')
            	//设置当前元素的内容
            	.html("DIV中的HTML内容")
            	.bind("click",function(){
            		//显示当前元素的内容
            		alert($('div').html());
            		//设置当前元素的内容
            		$('div').text("使用text()更改HTML内容");
            		//显示当前元素的内容
            		alert($('div').text());
            	})
            	.addClass("panel");
            //向页面追加四个元素
            $('<p></p><p></p>').appendTo($('body'));
            //遍历追加的元素，并为这些元素添加类和相关属性
            $("p").each(function(i){
           		$("p")
           			.eq(i)
           			.html("p"+i)
           			.addClass("line");
            });
            //使用$.each()遍历JSON对象
            $.each({0:"第一行", 1: "第二行"},function(i, n){
            	$("p")
           			.eq(i)
           			.html(n)
            });
        });
    </script>
    <style type="text/css">
        .panel{
            padding: 20px;
            background-color: #000000;
            color: #FFFFFF;
            font-weight: bold;
            width: 200px;
            height: 20px;
        }
        .line{
            padding: 5px;
            background-color: #000000;
            color: #FFFFFF;
            font-weight: bold;
            width: 200px;
            height: 20px;
        }
    </style>
</head>
 <body>
 </body>
</html>