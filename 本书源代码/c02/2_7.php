<!-------------------------------------------文件名： 2_7.php-------------------------------->
<!-- 建立一个产生POST外部变量的HTML表单 -->
<form id="form1" name="form1" method="POST" action="">
  <label>姓名
  <input name="name" type="text" id="name" />
  </label>
  <label>年龄
  <input name="age" type="text" id="age" />
  </label>
  <label>
  <input type="submit" name="Submit" value="提交" />
  </label>
</form>
<!-- 建立一个产生GET外部变量的HTML表单 -->
<form id="form2" name="form2" method="GET" action="">
  <label>学校
  <input name="school" type="text" id="school" />
  年级
  <select name="class" id="class">
    <option value="一年级" selected="selected">一年级</option>
    <option value="二年级">二年级</option>
    <option value="三年级">三年级</option>
    <option value="四年级">四年级</option>
  </select>
  </label>
  <input type="submit" name="Submit" value="提交" />
</form>
<p>&nbsp;</p>
<?php
echo "使用$"."_GET获取外部变量：<br><pre>";
print_r($_GET);
echo "</pre>使用$"."_POST获取外部变量：<br><pre>";
print_r($_POST);
echo "</pre>使用$"."_REQUEST获取外部变量：<br><pre>";
print_r($_REQUEST);
echo "</pre>"
?>
