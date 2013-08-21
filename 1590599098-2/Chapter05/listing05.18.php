<?php
require_once( 'ShopProduct.php' );

$product = getProduct();
if ( is_a( $product, 'ShopProduct' )  ) {
    print "\$product is a ShopProduct object\n";
}

function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}

?>
