<?php
require_once( 'ShopProduct.php' );

$product = getProduct(); // acquire an object
call_user_func( array( $product, 'setDiscount' ), 20 );

function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}
?>
