<?php
/***********************13_7.php********************************/
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
           //添加10个按钮
            $.each({0:"自定义动画", 1: "淡出", 2: "淡入", 3: "透明", 4: "隐藏", 5: "显示", 6: "减小", 7: "增大", 8: "增大/减小", 9: "显示/隐藏"},function(i, n){
            	$("<input type=button>")
            		.appendTo($('body'))
            		.val(n);
            });
            $("<div class='animate'>动画效果演示层</div>").appendTo($('body'));
            //找出所有按钮
            $('input:button').eq(0)
                    .click(function(){
                    	$('.animate').animate({
				        width: "70%",
				        opacity: 0.4,
				        marginLeft: "10",
				        fontSize: "14",
				        borderWidth: "10px"
				      }, 1500 );
                    })
                .end().eq(1)
                    .click(function(){
                    	$('.animate').fadeOut("slow");
                    })
                .end().eq(2)
                    .click(function(){
						$('.animate').fadeIn("normal");
                    })
                .end().eq(3)
                	.click(function(){
						$('.animate').fadeTo("fast",0.5);
                    })
                .end().eq(4)
                	.click(function(){
						$('.animate').hide("slow");
                    })
                .end().eq(5)
                	.click(function(){
						$('.animate').show("fast",function(){alert('快速显示图层');});
                    })
                .end().eq(6)
                	.click(function(){
						$('.animate').slideUp("slow");
                    })
                .end().eq(7)
                	.click(function(){
						$('.animate').slideDown("slow");
                    })
                .end().eq(8)
                	.click(function(){
						$('.animate').slideToggle("slow");
                    })
                .end().eq(9)
                	.click(function(){
						$('.animate').toggle("slow");
                    })
            });
    </script>
    <style type="text/css">
        .animate{
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