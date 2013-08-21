<!---------------------------------文件名： 3_14.php-------------------------------->
<html>
<head>
<title>万年月历</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb_2312">
<!-- Style -->
<style type=text/css >
<!--
table{
	background-color: #B0C4DE;
}
tr{
	background-color: White;
}
td{
  font-size: 20pt;
	font-family : 宋体;
	color: #708090;
    line-height: 140%;
}
-->
</style>
</head>
<body>
<?php
//检测用户是否提交数据
if(isset($_POST["year"])){
	//使用用户提交的数据作为年数据
	$year = $_POST["year"];
}else{
	//使用当前日期的年作为年数据
	$year = date("Y");
}
if(isset($_POST["month"])){
	$month = $_POST["month"];
}else{
	$month = date("m");
}
//初始化月数据
$date=01;
//初始化日数据
$day=01;
$off=0;
//检测年数据是否正确
if($year<0 or $year > 9999){
	//如果年数据不正确，显示错误信息，关返回上一页。
	echo "<script> alert('年份应在1至9999之间.');history.go(-1); </script>";
	exit();
}
if($month<0 or $month > 12){
	//如果月数据不正确，显示错误信息，关返回上一页。
	echo  "<script> alert('月份应在1至12月之间.');history.go(-1); </script> ";
	exit();
}
while(checkdate($month,$date,$year)){
	$date++;
}
//绘制万年历表头
?>
<form method=post action='' name=calendar>
	<table width=100% border=1 cellspacing=0 cellpadding=2 bordercolorlight=#333333 bordercolordark=#FFFFFF bgcolor=#CCCCFF>
	<tr align=center valign=middle>
		<td colspan=7 bgcolor=#efefef>
			<input type='text' name='year' size='4' maxlength='4' value=<?=$year?> >
			<input type='text' name='month' size='2' maxlength='2' value=<?=$month?> >
			<input type='submit' name='submit' align=absmiddle border=0 value='跳转'>
		</td>
	</tr>
	<tr align=center valign=middle>
		<td bgcolor=#efefef>日</td>
		<td>一</td>
		<td>二</td>
		<td>三</td>
		<td>四</td>
		<td>五</td>
		<td bgcolor=#efefef>六</td>
		</tr>
	<tr>
	<?php
	//构建万年历内容
	while ($day<$date){
		//设置日期颜色，如果是当前日期，使用红色进行标识
		if($day == date("d") && $year == date("Y") && $month == date("m")){
			$day_color = "red";
		}else{
			$day_color = "black";
		}
		//设置星期天数据
		if ($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) ==  'Sunday'){
			echo  "<td><font color=$day_color>$day</font></td>";
			$off =  '01';
		}elseif($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) == 'Monday'){
			//设置星期一的数据
			echo  "<td>&nbsp</td><td><font color=$day_color>$day</font></td>";
			$off=  '02';
	  	}elseif($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) == 'Tuesday'){
	  		//设置星期二的数据
	  		echo  "<td>&nbsp</td><td>&nbsp</td><td><font color=$day_color>$day</font></td>";
	  		$off=  '03';
	  	}elseif($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) == 'Wednesday'){
	  		//设置星期三的数据
			echo  "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td><font color=$day_color>$day</font></td>";
			$off=  '04';
		}elseif($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) == 'Thursday'){
			//设置星期四的数据
			echo  "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td><font color=$day_color>$day</font></td>";
			$off=  '05';
		}elseif($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) ==  'Friday') {
			//设置星期五的数据
			echo  "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td><font color=$day_color>$day</font></td>";
			$off=  '06';
		}elseif($day ==  '01' and date( 'l', mktime(0,0,0,$month,$day,$year)) ==  'Saturday') {
			//设置星期六的数据
			echo  "<td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td>&nbsp</td><td><font color=$day_color>$day</font></td>";
			$off=  '07';
		}else{
			//直接显示日期
			echo  "<td><font color=$day_color>$day</font></td> \n";
		}
		//递增while循环条件
		$day++;
		//设置开关变量
		$off++;
		//当$off大于7时，重起一行，并把$off变量置为1
		if ($off>7) {
			echo  "</tr><tr>";
			$off= '01';
		}else{
			echo  "";
		}
	}
	//计算剩下数据，使用空表格填充
	for($i=$off ; $i<=7 ; $i++){
		echo "<td>&nbsp</td>";
	}
	?>
	</tr>
	</table>
</form>
</body>
</html>
