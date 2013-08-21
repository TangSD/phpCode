<?php

/***********************13_8.php********************************/
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
           //添加6个按钮
            $.each({0:"使用GET方法请求数据", 1: "使用POST提交表单数据", 2: "同步更新数据", 3: "使用$.get获取服务器数据", 4: "使用$.post获取服务器数据", 5: "处理Error"},function(i, n){
            	$("<input type=button>")
            		.appendTo($('body'))
            		.val(n);
            });
            //添加一个用于显示信息的div
            $("<div class='message'>消息显示</div>").appendTo($('body'));
            //找出所有按钮
            $('input:button').eq(0)
                    .click(function(){
                    	//使用$.ajax的get方法，加载JS脚本
                    	$.ajax({
                    		type:"GET",
                    		//url指向需要加载的脚本文件
                    		url:"demo.js",
                    		//注意加载JS脚本时，dataType属性的值
                    		dataType:"script"
                    	});
                    })
                .end().eq(1)
                    .click(function(){
                    	//使用$.ajax的post方法，向服务器端提交数据
                    	$.ajax({
                    		type: "POST",
                    		//url属性的值指向服务器端文件
                    		url: "ajaxServices.php",
                    		//data属性的值是向服务器端提交的数据
                    		data: "action=save&title=客户端数据&detail=保存到服务器端",
                    		//success属性的值是一个回调函数，用于在数据提交成功后，处理返回数据
                    		success: function(msg){
                    			$(".message").append("<li>"+msg+"</li>");
                    		}
                    	});
                    })
                .end().eq(2)
                    .click(function(){
                    	//使用$.ajax实现客户端同步服务器端数据
                    	//关键属性async的值必须为false
						var html = $.ajax({ url: "ajaxServices.php?action=getHtml", async: false }).responseText;
						$(".message").append("<li>"+html+"</li>");
                    })
                .end().eq(3)
                	.click(function(){
                		//使用$.get()方法，获取服务器端的数据
						$.get(
							"ajaxServices.php",
							{ action:"methodGet"},
							function(msg){
								$(".message").append("<li>"+msg+"</li>");
							}
						);
                    })
                .end().eq(4)
                	.click(function(){
                		//使用$.post()方法，获取服务器端的数据
						$.post(
							"ajaxServices.php",
							{ action:"methodPost"},
							function(msg){
								$(".message").append("<li>"+msg+"</li>");
							}
						);
                    })
                 .end().eq(5)
                 	.click(function(){
                 		//向一个不存在的文件发送数据请求，以产生错误信息
                 		var html = $.ajax({ url: "none.php", async: false }).responseText;
                 		//使用ajaxError()来处理错误信息
                 		$(".message").ajaxError(
                 			function(request, settings){
                 				$(this).append("<li>AJAX错误</li>");
                 			}
                 		);
                 	}
                 )
            });
    </script>
    <style type="text/css">
        .message{
            padding: 20px;
            background-color: #000000;
            color: #FFFFFF;
            font-weight: bold;
            width: 200px;
        }
    </style>
</head>
 <body>
  </body>
</html>