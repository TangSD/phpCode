<?php
$classname = "Task";

require_once( "tasks/$classname.php" );
$myObj = new $classname();
$myObj->doSpeak();
?>
