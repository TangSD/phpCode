<?php

function __autoload( $classname ) {
    $path = str_replace('_', DIRECTORY_SEPARATOR, $classname );
    include_once( "$path.php" ); 
}

$y = new business_ShopProduct();
?>
