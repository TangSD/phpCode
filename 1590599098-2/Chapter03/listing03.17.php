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

    function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }

    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        return $base;
    }

    function getProductXml() {
        // empty implementation
    }
}

class CdProduct extends ShopProduct {
    function getPlayLength() {
        return $this->playLength;
    }
    
    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        $base .= ": playing time - $this->playLength";
        return $base;
    }
}

class BookProduct extends ShopProduct {
    function getNumberOfPages() {
        return $this->numPages;
    }
 
    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        $base .= ": page count - $this->numPages";
        return $base;
    }
}

$product1 = new BookProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new CdProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, null, 60.33 );

print "author:          ".$product1->getProducer()."\n";
print "number of pages: ".$product1->getNumberOfPages()."\n";
print "artist:          ".$product2->getProducer()."\n";
print "play length:     ".$product2->getPlayLength()."\n";

// output:
// author:          Willa Cather
// number of pages: 300
// artist:          The Alabama 3
// play length:     60.33
?>
