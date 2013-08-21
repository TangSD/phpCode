<?php

require_once( "ShopProduct.php" );

function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}

?>

