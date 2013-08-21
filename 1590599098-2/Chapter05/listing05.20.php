<?php
require_once( 'ShopProduct.php' );

$product = getProduct();
print_r( get_class_methods( 'CdProduct' ) );


function getProduct() {
    return new CdProduct(    "Exile on Coldharbour Lane",
                                "The", "Alabama 3", 10.99, 60.33 );
}

// Array
// (
//     [0] => __construct
//     [1] => getPlayLength
//     [2] => getSummaryLine
//     [3] => getProducerFirstName
//     [4] => getProducerMainName
//     [5] => setDiscount
//     [6] => getDiscount
//     [7] => getTitle
//     [8] => getPrice
//     [9] => getProducer
//     [10] => discountPrice
// )
 
?>
