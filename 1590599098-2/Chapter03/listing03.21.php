<?php
require_once( "listing03.20.php" );

class ShopProductWriter {
    private $products = array();

    public function addProduct( ShopProduct $shopProduct ) {
        $this->products[]=$shopProduct;
    }

    public function write() {
        $str = "";
        foreach ( $this->products as $shopProduct ) {
            $str .= "{$shopProduct->title}: " .
                    $shopProduct->getProducer() .
                    " ({$shopProduct->getPrice()})\n";
        }
        print $str;
    }
}
$product1 = new BookProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new CdProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, 60.33 );
$writer = new ShopProductWriter();
$writer->addProduct( $product1 );
$writer->addProduct( $product2 );
$writer->write();

?>
