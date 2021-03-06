<?php
class ShopProduct {
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;
    
    function __construct( $title, $firstName, $mainName, $price ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }
}

class ShopProductWriter {
    public function write( $shopProduct ) {
        $str  = "{$shopProduct->title}: " .
                $shopProduct->getProducer() .
                " ({$shopProduct->price})\n";
        print $str;
    }
}
$product1 = new ShopProduct( "My Antonia", "Willa", "Cather", 5.99 );
$writer = new ShopProductWriter();
$writer->write( $product1 );

// output:
// My Antonia: Willa Cather (5.99)

?>
