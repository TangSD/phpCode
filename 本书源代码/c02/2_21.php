<!-------------------------------------------文件名： 2_21.php-------------------------------->
<?php
//定义一个保存目录树数据的数组
$tree = array(
	array("id"=>1,"pid"=>0,"t"=>"总公司"),
	array("id"=>2,"pid"=>1,"t"=>"分公司1"),
	array("id"=>3,"pid"=>1,"t"=>"分公司2"),
	array("id"=>4,"pid"=>2,"t"=>"分公司1部门"),
	array("id"=>5,"pid"=>3,"t"=>"分公司2部门"),
	array("id"=>6,"pid"=>4,"t"=>"分公司1部门"),
	array("id"=>7,"pid"=>6,"t"=>"分公司1部门"),
	array("id"=>8,"pid"=>7,"t"=>"分公司1部门"),
	array("id"=>9,"pid"=>8,"t"=>"分公司1部门")
);
//定义一个查询数组内容函数
function getline($id){
	//访问全局变量$tree
	global $tree;
	//定义一个空数组
	$r = array();
	foreach($tree as $v){
		if($v["pid"]==$id){
			//记录属于同一个上级结点的数组
			$r[] = $v;
		}
	}
	//返回数组
	return $r;
}
//定义一个递归函数
function comtree($pid=0,$result="",$d=1){
	//取得数组中相关的数据
	$data = getline($pid);
	//遍历取回的数组，构建目录树
	foreach($data as $v){
		//处理目录树显示数据
		$result.=str_repeat("-",$d-1).$v["t"]."<br>";
		//递归调用函数本身
		comtree($v["id"],&$result,$d+1);
	}
	//当上级结点为0时，才显示树结构
	if($pid==0){
		print $result;
	}
}
comtree();
?>
