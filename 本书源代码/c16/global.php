<?php
//加载常用类
include 'class/mysql.class.php';
include 'class/table.class.php';
include 'class/cart.class.php';
$cart = new cart();
$table = new table();
class globalClass extends mysql{
	function globalClass($host,$user,$pass,$db,$charset,$pre){
		//链接数据库
		$this->mysql($host,$user,$pass,$db,$charset,$pre);
	}
	//用户认证函数
	function auth(){
		$email = $_SESSION["i"]["email"];
		$pass = $_SESSION["i"]["password"];
		$this->setSql("select id from #_members where email = '".$email."' and password = '".$pass."'");
		$this->query();
		if($this->getLines()<1){
			$this->alert('非法登录!','index.php');
		}
	}
	//登录用户信息
	function UserInfo(){
		$email = $_SESSION["i"]["email"];
		$pass = $_SESSION["i"]["password"];
		$this->setSql("select id,email,nickname,truename,sex,telphone,mobile,address from #_members where email = '".$email."' and password = '".$pass."'");
		$this->query();
		if($this->getLines()>=1){
			$user = $this->loadRow();
			echo '<li>登录邮箱：'.$user[1].'</li>';
			echo '<li>用户昵称：'.$user[2].'</li>';
			echo '<li>用户姓名：'.$user[3].'</li>';
			if($user[4]==1){
				echo '<li>性别：男</li>';
			}else{
				echo '<li>性别：女</li>';
			}
			echo '<li>电话：'.$user[5].'</li>';
			echo '<li>手机：'.$user[6].'</li>';
			echo '<li>地址：'.$user[7].'</li>';
		}else{
			$this->alert('非法登录!','index.php');
		}
	}
	//信息提示窗口
	function alert($info,$url,$time=3){
		echo $info;
		echo '<meta http-equiv="Refresh" content="'.$time.';url='.$url.'"/>';
		exit();
	}
	//登录信息显示
	function loginStats(){
		if(isset($_SESSION["i"])){
			switch ($_SESSION["i"]["admin"]){
				case "0":
					echo '
						欢迎：'.$_SESSION["i"]["truename"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="navlogin" href="index.php">主页</a>
						<a class="navlogin" href="product.php">产品列表</a>
						<a class="navlogin" href="cart.php">购物车</a>
						<a class="navlogin" href="logout.php">退出</a>
					';
				break;
				case "1":
					echo '
						欢迎：'.$_SESSION["i"]["truename"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="navlogin" href="index.php">主页</a>
						<a class="navlogin" href="product.php">产品列表</a>
						<a class="navlogin" href="cart.php">购物车</a>
						<a class="navlogin" href="user_order.php">订单管理</a>
						<a class="navlogin" href="user_product.php">产品管理</a>
						<a class="navlogin" href="user.php">管理</a>
						<a class="navlogin" href="logout.php">退出</a>
					';
				break;
			}
		}else{
			echo '
			<a class="navlogin" href="index.php">主页</a>
			<a class="navlogin" href="product.php">产品列表</a>
			<a class="navlogin" href="cart.php">购物车</a>
			<a class="navlogin" href="login.php">登录</a>
			<a class="navreg" href="register.php">新用户注册</a>
			';
		}
	}
	//布尔值转换
	function getTitle($key){
		$keys = array('true'=>'是','false'=>'否','1'=>'是','0'=>'否');
		return $keys[$key];
	}
	//推荐产品
	function commendProduct(){
		$this->setSql("select id,title,fileid from #_product where commend = 'YES' order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<LI id="'.$k.'"><a href="store.php?fileid='.$v[2].'">'.$v[1].'</a></LI>';
			}
		}else{
			echo '<LI>暂无推荐产品</LI>';
		}
	}
	//最新产品
	function newProduct(){
		$this->setSql("select id,title,fileid from #_product order by id desc limit 0,10");
		$this->query();
		if($this->getLines()>0){
			foreach($this->loadRowList() as $k=>$v){
				echo '<DIV class=user id="'.$k.'"><a href="store.php?fileid='.$v[2].'">'.$v[1].'</a></DIV>';
			}
		}else{
			echo '<LI>暂无产品</LI>';
		}
	}
	//获取产品相关图片
	function aboutFiles($folder,$fileid){
		include 'class/images.class.php';
		$img = new images();
		$this->setSql("select id,fileid,filename,filetype,filetitle from #_files where fileid = '".$fileid."'");
		$this->query();
		$st = $this->loadRowList(1);
		$img->singleShow($folder,$st);
	}
	//购物车
	function getCart(){
		global $cart,$table;
		$table->_name = 'cartlist';
		$data = $cart->listArray();
		if(count($data)>0){
			$header = array("编号","名称","数量","价格");
			echo $table->normal($header,$data);
		}else{
			echo '<LI>暂无产品</LI>';
		}
	}

}
$g = new globalClass("localhost","root","password","onlinestore","latin1","o");
?>
