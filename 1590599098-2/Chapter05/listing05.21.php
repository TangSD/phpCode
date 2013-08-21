<?php
require_once( 'ShopProduct.php' );

$product = getProduct(); // acquire an object
$method = "getTitle";     // define a method name
print $product->$method();  // invoke the method

function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}
?>
