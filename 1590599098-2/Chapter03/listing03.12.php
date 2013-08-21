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

$product1 = new ShopProduct(    "My Antonia", "Willa", "Cather", 5.99 );
$product2 = new ShopProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99 );
print "author: ".$product1->getProducer()."\n";
print "artist: ".$product2->getProducer()."\n";

// outputs:
// author: Willa Cather
// artist: The Alabama 3
?>
