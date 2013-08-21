<?php
//创建购物篮类
class cart{
	//向数组中添加个记录产品信息的数据
	function addItem($id,$title,$number,$price){
		//读取SESSION中的产品数据
		$temp = (array)$this->restore();
		//当产品已经存在时，只修改产品数量
		if(array_key_exists($id,$temp)){
			$temp[$id]["number"] = $temp[$id]["number"]+$number;
		}else{
			//产品不存在时，新建一条记录
			$temp[$id]["id"] = $id;
			$temp[$id]["title"] = $title;
			$temp[$id]["number"] = $number;
			$temp[$id]["price"] = $price;
		}
		//将数据保存到SESSION中
		$this->store($temp);
	}
	//根据ID，从数组中删除一条记录
	function removeItem($id){
		$temp = $this->restore();
		if(is_array($temp[$id])){
			unset($temp[$id]);
		}
		$this->store($temp);
	}
	//统计总的价格
	function _total(){
		$total = "";
		$temp = $this->restore();
		if(is_array($temp) and count($temp)>0){
			foreach($temp as $v){
				$total += $v["number"]*$v["price"];
			}
		}
		return $total;
	}
	//以数组形式返回购物篮的内容
	function listArray(){
		$temp = $this->restore();
		return $temp;
	}
	//恢复数据
	function restore(){
		//从SESSION数据中，读取购物篮数据
		$cart_items = $_SESSION["cart_items"];
		//将SESSION中的数据反序列化
		$items = unserialize(stripslashes($cart_items));
		//返回数据
		return $items;
	}
	//保存数据
	function store($items){
		//将购物篮数据序列化
		$items = serialize($items);
		//保存到SESSION中
		$_SESSION["cart_items"] = $items;
	}
	//清空数据
	function clear(){
		unset($_SESSION["cart_items"]);
	}
}
?>
