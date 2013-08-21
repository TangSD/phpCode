<?php
class ShopProduct {
    public $numPages;
    public $playLength;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;
    
    function __construct(   $title, $firstName, 
                            $mainName, $price, 
                            $numPages=0, $playLength=0 ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
        $this->numPages          = $numPages;
        $this->playLength        = $playLength;
    }
    
    function getNumberOfPages() {
        return $this->numPages;
    }

    function getPlayLength() {
        return $this->playLength;
    }

    function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }
}

$product1 = new ShopProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 = new ShopProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, null, 60.33 );

print "author:          ".$product1->getProducer()."\n";
print "number of pages: ".$product1->getNumberOfPages()."\n";
print "artist:          ".$product2->getProducer()."\n";
print "play length:     ".$product2->getPlayLength()."\n";

// author:          Willa Cather
// number of pages: 300
// artist:          The Alabama 3
// play length:     60.33
?>
