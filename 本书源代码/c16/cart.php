<?php
session_start ();
include 'global.php';
//获取以GET方法传递到本页的数据
if (isset ( $_GET ["id"] )) {
	$g->setSql ( "select id,title,mprice from #_product where fileid = '" . strval ( $_GET ["id"] ) . "'" );
	$p = NULL;
	$g->loadObject ( $p );
	$cart->addItem ( $p->id, $p->title, 1, $p->mprice );
}
//获取以POST方法传递到本页的数据
if (isset ( $_POST ["do"] )) {
	switch ($_POST ["do"]) {
		case "cart" :
			if (count ( $_POST ["cid"] ) > 0) {
				foreach ( $_POST ["cid"] as $v ) {
					$g->setSql ( "select id,title,mprice from #_product where id = '" . $v . "'" );
					$p = NULL;
					$g->loadObject ( $p );
					$cart->addItem ( $p->id, $p->title, 1, $p->mprice );
				}
			}
			break;
		case "delete":
			if(count($_POST["cid"])>0){
				foreach($_POST["cid"] as $v){
					$cart->removeItem($v);
				}
			}
		break;
		case "order" :
			if(isset($_SESSION["i"])){
				$cartArray = $cart->listArray();
				if(count($_POST["cid"])>0){
					$total = 0;
					foreach($_POST["cid"] as $id){
						$order = "";
						$order["pid"] = $cartArray[$id]["id"];
						$order["mid"] = $_SESSION["i"]["id"];
						$order["price"] = $cartArray[$id]["price"];
						$order["number"] = $cartArray[$id]["number"];
						$sprice = $cartArray[$id]["price"]*$cartArray[$id]["number"];
						$order["total"] = $sprice;
						$g->insertObject("#_order",$order);
						$total += $sprice;
					}
					//清空购物车数据
					$cart->clear();
					//显示结算数据，并返回首页
					$g->alert("结算成功，共计费用：".$total."元","index.php",5);
				}else{
					$g->alert("请选择确定购买的产品","cart.php",1);
				}
			}else{
				$g->alert("注册用户请 <a href='login.php'>登录</a> 后再进行结算，非注册用户请 <a href='register.php'>注册</a> 后再登录。","login.php",5);
			}
		break;
	}
}
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
<DIV class=wrap>
	<DIV class=left>
		<DIV class=commend>
			<DIV class=group>
				<DIV class=title>购物车物品列表</DIV>
				<DIV class=user>
		<?php
		$data = $cart->listArray();
		if(count($data)>0){
			$header = array("编号","名称","数量","价格");
			$toolbar = array(
				"delete" =>array("value"=>"删除选择的物品","action"=>""),
				"order" =>array("value"=>"结算","action"=>"")
			);
			echo $table->normal($header,$data,true,$toolbar);
			echo "共计：".$cart->_total()."元";
		}else{
			echo '<LI>暂无产品</LI>';
		}
		?>
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