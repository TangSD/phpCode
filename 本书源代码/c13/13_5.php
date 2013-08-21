<?php
/***********************13_5.php********************************/
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
            //添加四个层
            $('<div>第一行</div><div>第二行</div><div>第三行</div><div>关闭带样式的层</div>').appendTo($('body'));
            //找出所有层
            $('div').eq(0)//找到第一个层
                    .click(function(){//绑定click事件
                    	//为第一个图层添加样式
                    	$('div:eq(0)').addClass("panel");
                    	//将第一个图层的内容修改为
                    	$('div:eq(0)').html("单击事件后的第一行");
                    })
                .end().eq(1)//找到第二个层
                    .click(function(){
                        //将第二个图层的内容修改为
                    	$('div:eq(1)').html("单击事件后的第二行");
                    })
                .end().eq(2)//找到第三个层
                    .click(function(){//绑定click事件
                    	//为第一个图层添加样式
                    	$('div:eq(2)').addClass("panel");
                    	//将第一个图层的内容修改为
                    	$('div:eq(2)').html("解除第一层的click事件");
                    	$('div:eq(0)').unbind("click");
                    })
                .end().eq(3)//找到第四个层
                    .toggle(function(){
                    	$('div:eq(3)').html("显示带样式的层");
                        $('.panel').hide('slow');
                    },function(){
                    	$('div:eq(3)').html("关闭带样式的层");
                        $('.panel').show('slow');
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
    </style>

</head>
 <body>
 </body>
</html>