<?php
class ShopProduct {}

class ShopProductWriter {
    public function write( $shopProduct ) {
        $str  = "{$shopProduct->title}: " .
                $shopProduct->getProducer() .
                " ({$shopProduct->price})\n";
        print $str;
    }
}

class Wrong { }
$product1 = new ShopProduct( "My Antonia", "Willa", "Cather", 5.99 );
$writer = new ShopProductWriter();
$wrong  = new Wrong();
$writer->write( $wrong );

?>
