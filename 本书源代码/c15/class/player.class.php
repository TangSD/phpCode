<?php
class player{
	function player($file,$title,$width=500,$height=500){
?>
<script type="text/javascript" src="templates/js/jquery-1.2.6.js"></script>  
<script type="text/javascript" src="templates/js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="templates/js/jquery.metadata.js"></script>
<script type="text/javascript" src="templates/js/jquery.media.js"></script>
<script type="text/javascript" src="templates/js/swfobject.js"></script>
<script type="text/javascript">
    $(function() {
        $('a.media').media();
    });
</script>
<?php
		echo '<a class="media {width:'.$width.', height:'.$height.'}"  href="'.$file.'">'.$title.'</a>';
	}
}
?>