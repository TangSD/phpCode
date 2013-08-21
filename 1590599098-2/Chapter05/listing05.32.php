<?php
require_once( 'ShopProduct.php' );
$cdproduct = new ReflectionClass( 'CdProduct' );
Reflection::export( $cdproduct );


?>
