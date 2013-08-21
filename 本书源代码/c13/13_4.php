<?php

/***********************13_4.php********************************/
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
  $(document).ready(function(){
  	$('#eventblur').bind('blur',function(){alert("blur事件");});
  	$('#eventclick').bind('click',function(){alert("click事件");});
  	$('#eventchange').bind('change',function(){alert("change事件");});
  	$('#eventdblclick').bind('dblclick',function(){alert("dblclick事件");});
  	$('#eventfocus').bind('focus',function(){alert("focus事件");});
  	$("#eventhover").hover(function(){alert("over");},function(){alert("out"); });
  	$('#eventkeydown').bind('keydown',function(){alert("keydown事件");});
  	$('#eventkeypress').bind('keypress',function(){alert("keypress事件");});
  	$('#eventkeyup').bind('keyup',function(){alert("keyup事件");});
  	$('#eventmousedown').bind('mousedown',function(){alert("mousedown事件");});
  	$('#eventmouseover').bind('mouseover',function(){alert("mouseover事件");});
  	$('#eventmousemove').bind('mousemove',function(){alert("mousemove事件");});
  	$('#eventmouseup').bind('mouseup',function(){alert("mouseup事件");});
  	$('#eventselect').bind('select',function(){alert("select事件");});
  	$('#eventtoggle').toggle(function(){alert("接下");},function(){alert("再次接下"); });
  	$("#form1").submit(function(){ alert("a");});
  	$("#eventresize").bind('click',function(){
  		//改变元素尺寸，触发resize事件
		$("#eventresize").css("width",200);
	});
  	$("#eventresize").bind('resize',function(){alert("resize事件");});
  	$("body").bind("scroll",function(){alert("scroll事件");});
  	$("#eventone").one('click',function(){alert("只绑定一次的事件");});
  	$("#eventunbind").bind('click',function(){alert("click事件");});
  	$("#eventtrigger").click(function(event, a, b){

  	}).trigger("click", ["foo", "bar"]);
  	$("#eventtrigger").bind("myEvent",function(event,msg1,msg2){
  		alert(msg1 + ' ' + msg2);
  	});
  	$("#eventtrigger").trigger("myEvent",["trigger","事件"]);
  	$("#eventunbind").unbind();
  });

  </script>
</head>
 <body>
 <form id="form1" name="form1" metdod="post" action="">
   <table width="100%" border="1" cellpadding="0" cellspacing="0" widtd="100%">
     <tr>
       <td height="30"><label>
       <div align="center">blur事件
           <input name="eventblur" type="text" id="eventblur" />
       </div>
       </label></td>
       <td><label>
       <div align="center">click事件
           <input name="eventclick" type="button" id="eventclick" value="按钮" />
       </div>
       </label></td>
       <td><label>
       <div align="center">change事件
         <select name="eventchange" id="eventchange">
           <option value="1">1</option>
           <option value="2">2</option>
         </select>
       </div>
       </label></td>
       <td><div id="eventdblclick">
         <div align="center">dblclick事件双击</div>
       </div></td>
     </tr>
     <tr>
       <td height="30"><label>
       <div align="center">focus事件
           <input name="eventfocus" type="text" id="eventfocus" />
       </div>
       </label></td>
       <td><div id="eventhover">
         <div align="center">hover事件</div>
       </div></td>
       <td><div align="center">
         <label>keydown事件
         <input name="eventkeydown" type="text" id="eventkeydown" />
         </label>
       </div></td>
       <td><div align="center">
         <label>keypress事件
         <input name="eventkeypress" type="text" id="eventkeypress" />
         </label>
       </div></td>
     </tr>
     <tr>
       <td height="30"><div align="center">
         <label>keyup事件
         <input name="eventkeyup" type="text" id="eventkeyup" />
         </label>
       </div></td>
       <td><div align="center" id="eventmousedown">mouseDown事件</div></td>
       <td><div align="center" id="eventmouseover">mouseOver事件</div></td>
       <td><div align="center" id="eventmousemove">mouseMove事件</div></td>
     </tr>
     <tr>
       <td height="30"><div align="center" id="eventmouseup">mouseUp事件</div></td>
       <td><div align="center" id="">
         <label>select事件
         <input name="eventselect" type="text" id="eventselect" value="选择这些字符" />
         </label>
       </div></td>
       <td><div align="center">
         <label>toggle事件
         <input name="eventtoggle" type="button" id="eventtoggle" value="按钮" />
         </label>
       </div></td>
       <td><div align="center">
         <label>submit事件
         <input name="eventsubmit" type="submit" id="eventsubmit" value="提交" />
         </label>
       </div></td>
     </tr>
     <tr>
       <td height="30"> <div align="center" id='eventresize'>改变元素大小，触发resize事件</div></td>
       <td><div  align="center" id="eventunbind">unbind演示</div></td>
       <td><div  align="center" id="eventtrigger">trigger演示</div></td>
       <td><div  align="center" id="eventone">只绑定一次的事件</div></td>
     </tr>
   </table>
 </form>

 </body>
</html>