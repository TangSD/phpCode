<?php
class ShopProduct {
    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;
    private $discount = 0; 
    
    public function __construct(   $title, $firstName, 
                            $mainName, $price ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    public function getProducerFirstName() {
        return $this->producerFirstName;
    }

    public function getProducerMainName() {
        return $this->producerMainName;
    }

    public function setDiscount( $num ) {
        $this->discount=$num;
    }

    public function getDiscount() {
        return $this->discount;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getPrice() {
        return ($this->price - $this->discount);
    }

    public function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }

    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        return $base;
    }
}

class CdProduct extends ShopProduct {
    private $playLength = 0;

    public function __construct(   $title, $firstName, 
                            $mainName, $price, $playLength ) { 
        parent::__construct(    $title, $firstName, 
                                $mainName, $price );
        $this->playLength = $playLength;
    }

    public function getPlayLength() {
        return $this->playLength;
    }

    function getSummaryLine() {
        $base = parent::getSummaryLine();
        $base .= ": playing time - {$this->playLength}";
        return $base;
    }
 
}

class BookProduct extends ShopProduct {
    private $numPages = 0;

    public function __construct(   $title, $firstName, 
                            $mainName, $price, $numPages ) { 
        parent::__construct(    $title, $firstName, 
                                $mainName, $price );
        $this->numPages = $numPages;
    }

    public function getNumberOfPages() {
        return $this->numPages;
    }
   
    function getSummaryLine() {
        $base = parent::getSummaryLine();
        $base .= ": page count - {$this->numPages}";
        return $base;
    }

    public function getPrice() {
        return $this->price;
    }
}

$product1 = new BookProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new CdProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, 60.33 );
$product1->setDiscount( 1 );
print $product1->getPrice();
print "\n";
$product2->setDiscount( 1 );
print $product2->getPrice();
print "\n";
print "title:           ".$product1->getTitle()."\n";
print "producer first:  ".$product1->getProducerFirstName()."\n";
print "producer main:   ".$product1->getProducerMainName()."\n";
print "author:          ".$product1->getProducer()."\n";
print "number of pages: ".$product1->getNumberOfPages()."\n";
print "summary:         ".$product1->getSummaryLine()."\n";

print "title:           ".$product2->getTitle()."\n";
print "producer first:  ".$product2->getProducerFirstName()."\n";
print "producer main:   ".$product2->getProducerMainName()."\n";
print "artist:          ".$product2->getProducer()."\n";
print "play length:     ".$product2->getPlayLength()."\n";
print "summary:         ".$product2->getSummaryLine()."\n";

/*
// author:          Willa Cather
// number of pages: 300
// artist:          The Alabama 3
// play length:     60.33
*/
?>
