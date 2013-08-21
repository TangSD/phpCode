<?php
// listing05.06.php
$classname = "Task";
$path = "tasks/$classname.php";

if ( ! file_exists( $path ) ) {
    throw new Exception( "No such file as $path" );
} 
require_once( $path );
if ( ! class_exists( $classname ) ) {
    throw new Exception( "No such class as $classname" );
} 

$myObj = new $classname();
$myObj->doSpeak();
?>
