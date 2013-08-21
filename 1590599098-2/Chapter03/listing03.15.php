<?php
class CdProduct {
    public $playLength;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    function __construct(   $title, $firstName, 
                            $mainName, $price, 
                            $playLength ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
        $this->playLength        = $playLength;

    }

    function getPlayLength() {
        return $this->playLength;
    }

    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        $base .= ": playing time - $this->playLength";
        return $base;
    }

    function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }
}

class BookProduct {
    public $numPages;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;

    function __construct(   $title, $firstName, 
                            $mainName, $price, 
                            $numPages ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
        $this->numPages          = $numPages;
    }
 
    function getNumberOfPages() {
        return $this->numPages;
    }

    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        $base .= ": page count - $this->numPages";
        return $base;
    }

    function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }

}

$product1 = new BookProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new CdProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, 60.33 );

print "author:          ".$product1->getProducer()."\n";
print "number of pages: ".$product1->getNumberOfPages()."\n";
print "summary:         ".$product1->getSummaryLine()."\n";
print "artist:          ".$product2->getProducer()."\n";
print "play length:     ".$product2->getPlayLength()."\n";
print "summary:         ".$product2->getSummaryLine()."\n";

// output:
// author:          Willa Cather
// number of pages: 300
// summary:         My Antonia ( Cather, Willa ): page count - 300
// artist:          The Alabama 3
// play length:     60.33
// summary:         Exile on Coldharbour Lane ( Alabama 3, The ): playing time - 60.33

?>
