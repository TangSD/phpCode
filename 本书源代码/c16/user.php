<?php 
session_start();
include 'global.php';
$g->auth();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>网上购物</TITLE>
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
		网上购物
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank" name="search" id="search">
				<div class="input">
					<input type="hidden" name="type" value="file" /> 			
					<input class="input" name="keyword" type="text" onFocus="this.className='input2'"	value="搜产品" onClick="this.value='';"	onblur="this.value = this.value =='' ? '资源名称' : this.value;this.className='input'" />
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
//用户资源修改代码
if(isset($_POST["action"]) and $_POST["action"]=="editPassword"){
	$user["email"] = $_SESSION["i"]["email"];
	$user["password"] = md5(trim($_POST["pass1"]));
	$user["nickname"] = trim($_POST["nickname"]);
	$user["truename"] = trim($_POST["truename"]);
	$user["telphone"] = trim($_POST["telphone"]);
	$user["mobile"] = trim($_POST["mobile"]);
	$user["address"] = trim($_POST["address"]);
	$user["sex"] = intval(trim($_POST["gender"]));
	$g->updateObject("#_members",$user,"email");
	unset($_SESSION["i"]);
	$g->alert('用户资料修改成功，请重新登录...','index.php');
}else{
	$uid = $_SESSION["i"]["id"];
	$g->setSql("select nickname,truename,sex,telphone,mobile,address from #_members where id = ".$uid);
	$u = NULL;
	$g->loadObject($u);
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
							<li>
                            <div class="sp">昵称：</div>
                            <input class="input1" id="nickname" name="nickname" type="text" value="<?php echo $u->nickname; ?>" tabindex="4" />                            
                            </li>  
                            <li>
                            <div class="sp">姓名：</div>
                            <input class="input1" id="truename" name="truename" type="text" value="<?php echo $u->truename; ?>" tabindex="5" />                            
                            </li>       
                            <li>
                            <div class="sp">性别：
							<?php 
							if($u->sex==1){
								echo '<input type="radio" name="gender" id="gender_male" value="1"  tabindex="6" checked="checked" /><label for="gender_male">男</label>&nbsp;&nbsp;
							<input type="radio" name="gender" id="gender_female" value="0" tabindex="7" /><label for="gender_female">女</label>&nbsp;&nbsp;
								';
							}else{
								echo '<input type="radio" name="gender" id="gender_male" value="1"  tabindex="6" /><label for="gender_male">男</label>&nbsp;&nbsp;
							<input type="radio" name="gender" id="gender_female" value="0" tabindex="7" checked="checked" /><label for="gender_female">女</label>&nbsp;&nbsp;';
							}
							?>
							</div>
                            </li>
                            <li>
                            <div class="sp">电话：</div>
                            <input class="input1" id="telphone" name="telphone" type="text" value="<?php echo $u->mobile; ?>" tabindex="8" />                            
                            </li> 
                            <li>
                            <div class="sp">手机：</div>
                            <input class="input1" id="mobile" name="mobile" type="text" value="<?php echo $u->mobile; ?>" tabindex="9" />                            
                            </li> 
                            <li>
                            <div class="sp">地址：</div>
                            <textarea id="address" name="address" rows="4" cols="22" sborient="vertical" orient="vertical"><?php echo $u->address; ?></textarea>                            
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