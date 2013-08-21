<?php
session_start();
include 'global.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>网上购物</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css	href="templates/css/style.css">
<META name=GENERATOR content="MSHTML 6.00.6001.17184">
</HEAD>
<BODY>

<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		网上购物
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank">
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
<?php
if(isset($_GET["fileid"])){
	$fileid = strval($_GET["fileid"]);
	$g->setSql("select title,intro,price,mprice,fileid,commend,images from #_product where fileid = '".$fileid."'");
	$f = NULL;
	$g->loadObject($f);
}elseif(isset($_POST["do"]) and isset($_POST["cid"]) and count($_POST["cid"])>0){
	$fileid = end($_POST["cid"]);
	$g->setSql("select title,intro,price,mprice,fileid,commend,images from #_product where id = '".$fileid."'");
	$f = NULL;
	$g->loadObject($f);
}
?>
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title><?php echo $f->title;?></DIV>
				<DIV class=user>
					简介：<?php echo $f->intro;?><br>
				</DIV>
				<DIV class=user>
					市场价：<?php echo $f->price;?><br>
				</DIV>
				<DIV class=user>
					商城价：<?php echo $f->mprice;?><br>
				</DIV>
				<DIV class=user>
					推荐商品：<?php echo $f->commed;?><br>
				</DIV>
				<DIV class=user>
					<a href='cart.php?id=<?php echo $f->fileid; ?>'><strong>放入购物车</strong></a>
					<?php echo$g->aboutFiles($f->images,$f->fileid); ?>
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>购物车</DIV>
					<UL class=cool>
					<?php $g->getCart();?>
					</UL>
				</DIV>
			</DIV>
		</DIV>

		<DIV class=right>
			<DIV class=play>
				<DIV class=title>推荐产品</DIV>
					<DIV class=playwrap>
						<UL id=scrollPlay>
						<?php $g->commendProduct();?>
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