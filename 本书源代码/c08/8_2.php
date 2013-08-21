<?php
/*************************8_2.php****************************/
include("xml.php");
$xmlFile = "test.xml";
$xml = new xml();
$xml_content = $xml->parse($xmlFile);
xmlTable($xml_content);
nodecodeTable($xml_content);
function xmlTable($content){
	include("../c06/charset.php");
	$char = new Charset();
	$header = "<tr><th>姓名</th><th>年龄</th><th>工作</th></tr>";
	$body = "";
	foreach($content as $k=>$v){
		$body .= "<tr><td>".$char->utf82gb($v->name)."</td><td>".$char->utf82gb($v->age)."</td><td>".$char->utf82gb($v->job)."</td></tr>";
	}
	echo "<table border=1>".$header.$body."</table>";
}
function nodecodeTable($content){
	$header = "<tr><th>姓名</th><th>年龄</th><th>工作</th></tr>";
	$body = "";
	foreach($content as $k=>$v){
		$body .= "<tr><td>".$v->name."</td><td>".$v->age."</td><td>".$v->job."</td></tr>";
	}
	echo "<table border=1>".$header.$body."</table>";
}
?>