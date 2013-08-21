<!-------------------------------------------文件名： 2_22.php-------------------------------->
<?php
function u_1() {
    echo "这是函数u_1<br />";
}

function u_2($title) {
    echo "这是函数u_2,其参数是".$title.".<br />\n";
}

class runf{
	function u_3(){
	    echo "这是运行于类中的函数u_3";
	}
}

$function = "u_1";
$function();
$function = "u_2";
$function("2");
$function = "u_3";
$nrunf = new runf();
$nrunf->$function();
?>
