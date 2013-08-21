<?php 
session_start();
include 'global.php';
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
		var username = $o.username.value;
		var password = $o.password.value;
		var namerole = /^([a-zA-Z0-9]|[-_]){3,16}$/;
		var passrole = /^([a-zA-Z0-9]|[-_]){6,16}$/;
		var fail = "";
		if (!namerole.exec(username)){
			fail += '请输入正确的用户名\n\r';
		}
		if (!passrole.exec(password)){
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
				<DIV class=title>用户登录</DIV>
				<DIV class=user>
<?php
//用户注册代码
if(isset($_POST["action"]) and $_POST["action"]=="login"){
	$g->setSql("select id from #_user where username = '".trim($_POST["username"])."' and password = '".md5(trim($_POST["password"]))."'");
	$g->query();
	if($g->getLines()>0){
		$user = $g->loadRow();
		$_SESSION["i"]["id"] = $user[0];
		$_SESSION["i"]["username"] = trim($_POST["username"]);
		$_SESSION["i"]["password"] = md5(trim($_POST["password"]));
		$g->alert('用户登录成功，请稍后...','user.php');	
	}else{
		echo $g->getLines();
		echo '<font color="red">无效的登录信息，请重试！</font>';
	}
}
?>
<!---------表单开始--------->
                <form id="reg" name="reg" action="login.php" method="POST" onSubmit="return checkSubmit(this);">
                    <div class="info" id="form_el_list">
                        <ul>
                            <li>
                            <div class="sp">用户名：</div>
                            <input class="input1" id="username" name="username" type="text" value="" tabindex="12" />
                            </li>
                            <li>
                            <div class="sp">密码：</div>
                            <input class="input1" name="password" type="password" value="" id="password"  tabindex="14" />                            
                            </li>
                            <li>
                          </ul>
        			</div>
        <div class="center">
			<input class="but1" name="" type="submit" value="登录系统" />
			<input type="hidden" name="action" value="login">
		</div>
</form>


<!---------表单结束--------->
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>登录说明</DIV>
					<UL class=cool>
						<div><strong>用户名：</strong>至少三位，最多16位的英文、符号或者数字。</div><br>
						<div><strong>密码：</strong>至少六位，最多16位的英文、符号或者数字。</div><br>
					</UL>
		  </DIV>
			</DIV>
		</DIV>

		<DIV class=right>
			<DIV class=play>
				<DIV class=title>最新注册用户</DIV>
					<DIV class=playwrap>
						<UL id=scrollPlay>
						<?php $g->newUser();?>							
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