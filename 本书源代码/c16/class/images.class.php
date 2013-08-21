<?php
class images{
	/**
	* 幻灯片模式显示图片
	* 拥有开始和暂停按钮，单击放大
	* **/
	function lantern($folder,$images){
?>
<link rel="stylesheet" type="text/css" media="screen" href="templates/css/photoslider.css" />
<script type="text/javascript" src="templates/js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="templates/js/photoslider.js"></script>
<div class="photoslider" id="default"></div>

<script type="text/javascript">
$(document).ready(function(){
    //初始化文件目录与缩略图目录
	FOTO.Slider.baseURL = ".";
    FOTO.Slider.fileURL = '<?php echo $folder;?>';
    FOTO.Slider.thumbFileURL = '<?php echo $folder;?>/thumbnail';
    FOTO.Slider.bucket = {
        'default': {
<?php
$js_array = "";
$li_array = "";
foreach($images as $k=>$v){
	$js_array[] = '"'.$v[2].'"';
	$li_array[]= '"'.$v[2].'"'.": {'thumb': '".$folder."/thumbnail/".$v[2].".jpg.jpg', 'main': '".$folder."/".$v[2]."', 'caption': '".$k.$v[4]."'}";
}
echo implode(",",$li_array);
?>
        }
    };
    var ids = new Array(<?php echo implode(",",$js_array);?>);
    FOTO.Slider.importBucketFromIds('default',ids);
    FOTO.Slider.reload('default');
    FOTO.Slider.preloadImages('default');
    FOTO.Slider.enableSlideshow('default');
});
</script>
<?php
	}
	//滑动显示
	function slideview($folder,$images,$width=600,$height=500){
?>
<link rel="stylesheet" type="text/css" media="screen" href="templates/css/slideview.css" />
<script type="text/javascript" src="templates/js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="templates/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="templates/js/jquery.slideviewer.1.1.js"></script>
<div id="mygalone" class="svw">
     <ul>
<?php
foreach($images as $k=>$v){
	echo '<li><img alt="'.$k.".".$v[4].'"  src="'.$folder."/".$v[2].'" width="'.$width.'" height="'.$height.'" /></li>';
}
?>
     </ul>
</div>
<script type="text/javascript">
	$(window).bind("load", function(){
		$("div#mygalone").slideView()
	});
</script>
<?php
	}
	//网格列表显示
	function gridview($folder,$images){
?>
<link rel="stylesheet" type="text/css" media="screen" href="templates/css/gridview.css" />
<script type="text/javascript" src="templates/js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="templates/js/jqGalViewIII.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#Gallery').jqGalViewIII();
	});
</script>
	<ul title="My Gallery" id="Gallery">
<?php
foreach($images as $k=>$v){
	echo '<li><a href="'.$folder."/".$v[2].'"><img src="'.$folder."/thumbnail/".$v[2].'.jpg" alt="'.$k.".".$v[4].'" width="72" height="48" border="0"/></a></li>';
}
?>
	</ul>
<?php
	}
	//单个图片单击放大显示，带有遮罩效果
	function singleShow($folder,$images,$width=100,$height=100){
?>
<link rel="stylesheet" type="text/css" media="screen" href="templates/css/singleshow.css" />
<script type="text/javascript" src="templates/js/jquery-1.2.6.js"></script>
<script src="templates/js/iutil.js" type="text/javascript"></script>
<script src="templates/js/ifx.js" type="text/javascript"></script>
<script src="templates/js/ifxslide.js" type="text/javascript"></script>
<script src="templates/js/ifxdrop.js" type="text/javascript"></script>
<script src="templates/js/ifxblind.js" type="text/javascript"></script>
<script type="text/javascript" src="templates/js/imagebox_new.js"></script>
<ul title="My Gallery" id='Gallery'>
<?php
foreach($images as $k=>$v){
	echo '<li><a href="'.$folder.'/'.$v[2].'" title="'.$k.'.'.$v[4].'" rel="imagebox-lights"><img src="'.$folder.'/thumbnail/'.$v[2].'.jpg"  width="'.$width.'" height="'.$height.'"/></a></li>';
}
?>
<script type="text/javascript">
$(document).ready(
	function()
	{
		$.ImageBox.init(
			{
				loaderSRC: 'templates/images/loading.gif',
				closeHTML: '<img src="templates/images/close.jpg" />'
			}
		);
	}
);
</script>
<?php
	}
}
?>