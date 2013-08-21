<!---------------11_1.php------------------->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
 <head>
  <title>用户注册</title>
 </head>
 <body>
<form name="register" action="user.php?action=register" method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="0"  class="pad10L">
	<tr><td height="72" valign="top"><div>认证码：</div><input type="text" id="vercode" name="vercode" size="20" maxlength="14" value=""><img src='../c09/9_3.php'></td></tr>
	<tr><td height="72" valign="top"><div>用户名：</div><input type="text" id="username" name="username" size="20" maxlength="14" value="">&nbsp;&nbsp;&nbsp;<div class="item_desc">不超过7个汉字，或14个字节(数字，字母和下划线)</div></td></tr>
	<tr><td height="88" valign="top"><div><b>密码：</b><span style="margin-left:75px"><b>确认密码：</b></span></div><input type="password" name="pass1" id="txtloginpass" style="width:96px" value="" >&nbsp;&nbsp;&nbsp;<input type="password" name="pass2"  style="width:96px" value=""><div class="item_desc">最少4个字符,不超过14个字符(数字，字母和下划线)</div></td></tr>
	<tr><td height="56" valign="top"><div><div>性别：</div><input name="sex" type="radio" value="1" checked="checked" />男<input type="radio" name="sex" value="2" />女</td></tr>
	<tr><td height="80" valign="top"><div><div>电子邮件地址：</div><input type="text" name="email" style="width:192px" value=""><div class="item_desc">请输入有效的邮件地址，当密码遗失时凭此领取</td></tr>
	<tr><td valign="top"><div style="margin:10px 0 10px 0"><input name="submit" type="submit"  value=" 同意以下协议并提交 " id="btn_submit" style="width:145px; font-size:14px"></div><textarea name="textarea" cols="" rows="" readOnly="true" style="width:480px;height:110px;font-size:12px;color:#666">用户注册协议</textarea></td></tr>
</table>
</form>
 </body>
</html>
