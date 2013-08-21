<?php 
session_start();
include 'global.php';
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
				<DIV class=title>搜索结果</DIV>
				<DIV class=user>
<?php
		$keyword = strval($_POST["keyword"]);
		$g->setSql("select id,filetitle,filetype from #_files where 1 and filetitle like '%".$keyword."%' or fileintro like '%".$keyword."%' order by id desc");
		$g->query();
		if($g->getLines()>0){
			foreach($g->loadRowList() as $k=>$v){
				echo '<LI>['.$g->getFileType($v[2]).']<a href="file.php?id='.$v[0].'">'.$v[1].'</a></LI>';
			}
		}else{
			echo '<LI>没有相关资源</LI>';
		}
?>
				</DIV>
			</DIV>
			<DIV class=space>
				<DIV class=title>最新专辑</DIV>
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