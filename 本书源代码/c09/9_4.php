<?php
/******************************9_4.php****************************************/
//定义一个用于生成饼状图的函数
function showData($array){
	//创建一个图形句柄
	$image = imagecreate(400,400);
	//设置背景颜色
	$bgColor = imagecolorallocate($image,255,255,255);
	//定义饼状图的中心点
	$x = 200;
	$y = 200;
	//定义椭圆弧的宽度和高度
	$w = 380;
	$h = 380;
	//定义一个计数器,用于指定存储临时数据
	$i = 0;
	//创建一个数组存储颜色变量名
	$color = array($while,$gray,$darkgray,$navy,$darknavy,$red,$darkred);
	//画出椭圆弧,并填充颜色
	foreach($array as $point){
		//随机取得颜色
		$rc = imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));
		//根据指字参数,画出椭圆弧并使用颜色填充
		imagefilledarc($image, $x, $y, $w, $h,$i,$point,$rc, IMG_ARC_PIE);
		$i = $point;
	}
	//输出头文件信息
	header('Content-type: image/png');
	//输出PNG图形
	imagepng($image);
	//释放资源
	imagedestroy($image);
}
//定义一个用于存储调查数据的数组
$array = array(0,20,160,220,360);
//根据数组中的数据,画出饼状图
showData($array);
?>
