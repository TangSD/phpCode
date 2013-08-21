<!---------------11_2.php------------------->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en_US" xml:lang="en_US">
 <head>
  <title>用户注册</title>
 </head>
 <body>
<form id="login" name="login" method="post" action="user.php?action=login">
  <table border="0" align="center" cellpadding="0" cellspacing="5">
    <tr>
      <td><div align="right">用户名：</div></td>
      <td><label>
        <input type="text" name="username" />
      </label></td>
    </tr>
    <tr>
      <td><div align="right">密码：</div></td>
      <td><label>
        <input type="password" name="password" />
      </label></td>
    </tr>
    <tr>
      <td><div align="right">认证码：</div></td>
      <td><input type="text" name="vercode" /><img src='../c09/9_3.php'></td>
    </tr>
    <tr>
      <td colspan="2"><label>
        <div align="center">
          <input type="submit" name="Submit" value="登录" />
          </div>
      </label></td>
    </tr>
  </table>
</form>
 </body>
</html>
