<?php
require_once( 'ShopProduct.php' );

$product = getProduct();
print get_class( $product );
if ( get_class( $product ) == 'cdproduct' ) {
    print "\$product is a CdProduct object\n";
}

function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}
?>
