<!---------------------------------------文件名： 5_3.php-------------------------------->
<?php
//设置FTP链接使用的变量
//FTP服务器地址
$ftp_server = 'FTP地址';
//FTP登录时用户名和密码
$ftp_user = 'FTP用户名';
//FTP登录用户对应的密码
$ftp_pass = 'FTP密码';
//检查$_GET["action"]是否设置
if(isset($_GET["action"])){
	$action = $_GET["action"];
}else{
	$action = "showForm";
}
//根据变量调用相关代码或函数
switch($action){
	case "showFile":
		//显示选择文件窗口
		showFile();
	break;
	case "showForm":
		//显示上传窗口
		showForm();
	break;
	case "upload":
		//链接FTP服务器
		//使用ftp_connect()函数，取得FTP链接句柄，如果失败，显示错误信息
		$ftp = ftp_connect($ftp_server) or die("链接FTP服务器失败！");
		//使用ftp_login()函数，登录FTP服务器
		$ftp_result = ftp_login($ftp, $ftp_user, $ftp_pass);
		//检查登录状态，如果ftp_connect()和ftp_login()函数返回的都是FALSE值，显示链接失败信息
		if((!$ftp)||(!$ftp_result)){
			echo '链接FTP服务器失败!请检查FTP相关参数!<br>';
			exit();
		}else {
			echo 'FTP登录成功！<br>';
		}
		foreach($_POST["ftp"] as $key=>$file){
			//设置上传文件名，如果为空，跳过此次循环
			if($file == ""){
				continue;
			}else{
				//设置上传文件和目标文件s
				$source_file      = $file;
				$destination_file = $file;
			}
			//设置远程存储文件的目录和文件名
			//使用ftp_put()函数，上传源文件到目标文件夹
			$upload = ftp_put($ftp, $destination_file, $source_file, FTP_BINARY) or die("链接FTP服务器失败！");
			//检查上传状态
			if ($upload==false) {
				echo '文件上传失败!<br>';
			}else{
				echo '源文件上传成功！<br>';
			}
		}
		//关闭FTP链接
		ftp_close($ftp);
	break;
}
function showForm(){
?>
<form action="?action=upload" method="post" name="sendfile">
<div id="filehtml">
  选择上传文件1: <input name="ftp[1]" type="text" id="ftp[1]" /> <input type="button" name="Submit1" value="浏览" onclick="window.open('5_3.php?action=showFile&source=1');" /><br>
   选择上传文件2: <input name="ftp[2]" type="text" id="ftp[2]" /> <input type="button" name="Submit2" value="浏览" onclick="window.open('5_3.php?action=showFile&source=2');" /><br>
   选择上传文件3: <input name="ftp[3]" type="text" id="ftp[3]" /> <input type="button" name="Submit3" value="浏览" onclick="window.open('5_3.php?action=showFile&source=3');" /><br>
</div>

  <input type="button" name="addfile" value="增加文件上传框" onclick="addFileHtml();"/>

<br>

  <input type="submit" name="Submit" value="FTP上传"/>


</form>
<script language="JavaScript" type="text/javascript">
function addFileHtml(){
	var form = document.getElementById('sendfile');
	var count = 1;
	for(var i=0; i<form.elements.length; i++){
		var name = form.elements[i].name;
		if(name.indexOf("ftp") > -1) count++;
	}
	document.getElementById("filehtml").innerHTML += '选择上传文件'+count+': <input name="ftp['+count+']" type="text" id="ftp['+count+']" /> <input type="button" name="Submit'+count+'" value="浏览" onclick="window.open(\'5_3.php?action=showFile&source='+count+'\');" /><br>';
}
</script>
<?php
}
function showFile(){
	$source = intval($_GET["source"]);
	$sd=realpath("html");
	if(trim($sd)!=''){
		$d=dir($sd);
		while(false!==($entry=$d->read())){
			$p=$sd.'\\'.$entry;
			if(is_dir($p)){
			}else{
				echo "<tr><td><input type='button' onclick='selectFile(\"".$entry."\");' value='".$entry."'></td></tr>";
			}
		}
	  	$d->close();
	}
	echo '<script language="javascript">
function selectFile(fn){
	opener.document.getElementById("ftp['.$source.']").value="html/"+fn;
	window.close();
}
</script>';
}
?>