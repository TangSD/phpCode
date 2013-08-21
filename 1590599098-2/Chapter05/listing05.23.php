<?php
require_once( 'ShopProduct.php' );

$product = getProduct(); // acquire an object
$method = "getTitle";     // define a method name

if ( is_callable( array( $product, $method) ) ) {
    print $product->$method();  // invoke the method
} else {
    print "not callable\n";
}

function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}
?>
