<?php 
session_start();
include 'global.php';
include 'class/exif.class.php';
include 'class/images.class.php';
include 'class/player.class.php';
$id = intval($_GET["id"]);
$g->setSql("select fileid,filename,filetype,filetitle,fileintro from #_files where id = '".$id."'");
$f = NULL;
$g->loadObject($f);
$folder = $g->get("folder","pathto","fileid",$f->fileid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<TITLE>多媒体文件共享平台</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK rel=stylesheet type=text/css	href="templates/css/style.css">
<META name=GENERATOR content="MSHTML 6.00.6001.17184">
</HEAD>
<BODY>
<DIV id=navwrap class=navwrap>
	<div class="nav">
	<div class="navinner"><br>
		多媒体文件共享平台
			<div class="navsearch" style="left: 735px">
				<form action="search.php" method="post" target="_blank">
				<div class="input">
					<input type="hidden" name="type" value="file" /> 			
					<input class="input" name="keyword" type="text" onFocus="this.className='input2'"	value="搜资源" onClick="this.value='';"	onblur="this.value = this.value =='' ? '资源名称' : this.value;this.className='input'" />
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
				<DIV class=title><strong>文件名：</strong><?php echo $f->filetitle;?></DIV>
				<strong>文件介绍：</strong><?php echo $f->fileintro;?>
				<DIV class=user>图片查看方式：
				<a href='file.php?showtype=lantern&id=<?php echo $id;?>'>幻灯片</a> | 
				<a href='file.php?showtype=slideview&id=<?php echo $id;?>'>滑动切换</a> | 
				<a href='file.php?showtype=gridview&id=<?php echo $id;?>'>网格切换</a> | 
				<a href='file.php?showtype=singleShow&id=<?php echo $id;?>'>放大模式</a> | 
<?php
//根据参数，切换图片显示效果
if(isset($_GET["showtype"])){
	$st = $_GET["showtype"];
}else{
	$st = "singleShow";
}
$images = array(
	0=>array(1=>$f->fileid,2=>$f->filename,3=>$filetype,4=>$f->filetitle)
);
switch($f->filetype){
	case "image/png":
	case "image/pjpeg":
	case "image/gif":
		$img = new images();
		$exif = new exif();
		$img->$st($folder,$images);
		$exif->exifshow($folder."/".$f->filename);
	break;
	default:
		$player = new player($folder."/".$f->filename,$f->filetitle);
}
?>
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>专辑</DIV>
					<UL class=cool>
					<?php $g->newFolder();?>
					</UL>
				</DIV>
			</DIV>
		</DIV>

		<DIV class=right>
			<DIV class=play>
				<DIV class=title>最新注册用户</DIV>
					<DIV class=playwrap>
						<UL id=scrollPlay>
						<?php $g->newUser();?>							
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