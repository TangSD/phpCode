<?php 
session_start();
include 'global.php';
$g->auth();
$uid = $_SESSION["i"]["id"];
if($_SESSION["i"]["admin"]==0){
	$g->alert("无权访问该页!","index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>网上购物</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css href="templates/css/style.css">
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
<div class="nav">
<div class="navinner"><br>
网上购物
<div class="navsearch" style="left: 735px">
<form action="search.php" method="post" target="_blank" name="search"
	id="search">
<div class="input"><input type="hidden" name="type" value="file" /> <input
	class="input" name="keyword" type="text"
	onFocus="this.className='input2'" value="搜产品" onClick="this.value='';"
	onblur="this.value = this.value =='' ? '资源名称' : this.value;this.className='input'" />
</div>
<input class="but" type="submit" value=" " /></form>
</div>
<div class="other" style="left: 200px">
			<?php $g->loginStats();?>
			</div>

</div>
</div>
</DIV>
<DIV class=wrap>
<DIV class=left>
<DIV class=commend>
<DIV class=group>
<DIV class=title>产品列表</DIV>
<DIV class=user>
<?php
//表单处理代码
if(isset($_POST["do"])){
	$action = strval($_POST["do"]);
	$error = "";
	switch($action){
		case "over":
			$total = count($_POST["cid"]);
			if($total>0){
				foreach($_POST["cid"] as $k=>$v){
					$g->setSql("update #_order set `over` = 1 where id = '".$v."'");
					$g->query();
				}
				echo '共发货'.$total.'件，发货成功！';
			}else{
				echo '请选择货品记录';	
			}
		break;
	}
}
?>
<!---------列表开始--------->
<?php
$header = array("ID","产品名称","市场价","商城价","推荐");
$g->setSql("select b.id,a.title,a.price,a.mprice,a.commend from #_product a,#_order b where a.id = b.pid and b.over = 0");
$g->query();
$data = $g->loadRowList(1);
$toolbar = array(
	"over"=>array("value"=>"完成发货","action"=>"")
);
echo $table->normal($header,$data,true,$toolbar);
?>
<!---------列表结束---------></DIV>
</DIV>
<DIV class=space>
<DIV class=title>说明</DIV>
<form name="newFolder" id="newFolder" method="post"
	action="user_product.php" onSubmit="return checkSubmit(this);">
<UL class=cool>
	<br>
	<div>选择需要发货的记录，单击完成发货按钮，完成发货动作。</div>
</UL>
</form>
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