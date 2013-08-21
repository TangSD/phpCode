<?php
//判断是否有数据提交
if(isset($_REQUEST["action"])){
	$action = strval($_REQUEST["action"]);
	//根据$action变量，来输出相应的内容
	switch($action){
		case "save":
			$title  = $_POST['title'];
			$detail = $_POST['detail'];
			file_put_contents("fromClient.txt",$title."<br>".$detail);
			print "OK";
		break;
		case "getHtml":
			print(date("Y-m-d H:i:s"));
		break;
		case "methodGet":
			print("get");
		break;
		case "methodPost":
			print("post");
		break;
	}
}else{
	//输出约定的错误信息
	print("error");
}
?>
