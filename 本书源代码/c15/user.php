<?php 
session_start();
include 'global.php';
$g->auth();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>多媒体文件共享平台</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css	href="templates/css/style.css">
<script>
	//Javascript表单检验
	function checkSubmit($o){
		var fail = "";
		var pass1 = $o.pass1.value;
		var pass2 = $o.pass2.value;
		var passrole = /^([a-zA-Z0-9]|[-_]){6,16}$/;
		if(pass1!=pass2){
			fail += '两次输入的密码不相同\n\r';
		}
		if (!passrole.exec(pass1)){
			fail += '请输入正确的密码\n\r';
		}
		if(fail == ""){
			return true;
		}else{
			alert(fail);
			return false;
		}
	}

</script>
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		多媒体文件共享平台
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank" name="search" id="search">
				<div class="input">
					<input type="hidden" name="type" value="file" /> 			
					<input class="input" name="keyword" type="text" onFocus="this.className='input2'"	value="搜资源" onClick="this.value='';"	onblur="this.value = this.value =='' ? '资源名称' : this.value;this.className='input'" />
				</div>
				<input class="but"	type="submit" value=" " /></form>
			</div>
			<div class="other" style="left:200px">
			<?php $g->loginStats();?>
			</div>
			
	  </div>
	</div>
</DIV>
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title>修改密码</DIV>
				<DIV class=user>
<?php
//用户注册代码
if(isset($_POST["action"]) and $_POST["action"]=="editPassword"){
	$user["username"] = $_SESSION["i"]["username"];
	$user["password"] = md5(trim($_POST["pass1"]));
	$g->updateObject("#_user",$user,"username");
	unset($_SESSION["i"]);
	$g->alert('用户密码修改成功，请重新登录...','index.php');
}
?>
<!---------表单开始--------->
                <form id="reg" name="reg" action="user.php" method="POST" onSubmit="return checkSubmit(this);">
                    <div class="info" id="form_el_list">
                        <ul>
                          <li></li>
                            <li>
                            <div class="sp">密码：</div>
                            <input class="input1" name="pass1" type="password" value="" id="password"  tabindex="14" />                            
                            </li>
                            <li>
                            <div class="sp">确认：</div>
                            <input class="input1" name="pass2" id="pwd2" type="password" value="" tabindex="16" />                            
                            </li> 
						  <li></li>       
                          <li></li>
						  <li></li>

						</ul>
        			</div>
        <div class="center">
			<input class="but1" name="" type="submit" value="修改密码" />
			<input type="hidden" name="action" value="editPassword">
		</div>
</form>


<!---------表单结束--------->
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>说明</DIV>
					<UL class=cool><br>
						<div><strong>密码：</strong>至少六位，最多16位的英文、符号或者数字。</div><br>
						<div><strong>确认：</strong>请重复上面的密码。</div><br><br><br>
					</UL>
		  </DIV>
			</DIV>
		</DIV>

		<DIV class=right>
			<DIV class=play>
				<DIV class=title>登录用户信息</DIV>
					<DIV class=playwrap>
						<UL id=scrollPlay>
						<?php $g->UserInfo();?>							
						</UL>
					</DIV>
				</DIV>
			</DIV>
		</DIV>

		<DIV class=clear></DIV>
	</DIV>
</DIV>
<DIV class=footer>版权所有</DIV>

</BODY>
</HTML>