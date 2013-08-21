<?php
class ShopProduct {
    public $title;
    public $producerMainName;
    public $producerFirstName;
    protected $price;
    public $discount = 0; 
    
    function __construct(   $title, $firstName, 
                            $mainName, $price, 
                            $numPages=0, $playLength=0 ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
    }

    function setDiscount( $num ) {
        $this->discount=$num;
    }

    function getPrice() {
        return ($this->price - $this->discount);
    }

    function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }

    function getProductXml() {
        // empty implementation
    }
}

class CdProduct extends ShopProduct {
    public $playLength = 0;

    function __construct(   $title, $firstName, 
                            $mainName, $price, $playLength ) { 
        parent::__construct(    $title, $firstName, 
                                $mainName, $price );
        $this->playLength = $playLength;
    }

    function getPlayLength() {
        return $this->playLength;
    }
    
    function getProductXml() {
        return '<product type="cd" />';
    }
}

class BookProduct extends ShopProduct {
    public $numPages = 0;

    function __construct(   $title, $firstName, 
                            $mainName, $price, $numPages ) { 
        parent::__construct(    $title, $firstName, 
                                $mainName, $price );
        $this->numPages = $numPages;
    }

    function getNumberOfPages() {
        return $this->numPages;
    }
    
    function getProductXml() {
        return '<product type="book" />';
    }

    function getPrice() {
        return $this->price;
    }
}

/*
$product1 = new BookProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new CdProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, 60.33 );
$product1->setDiscount( 1 );
print $product1->getPrice();
print "\n";
$product2->setDiscount( 1 );
print $product2->getPrice();
print "\n";
*/
/*
print "author:          ".$product1->getProducer()."\n";
print "number of pages: ".$product1->getNumberOfPages()."\n";
print "artist:          ".$product2->getProducer()."\n";
print "play length:     ".$product2->getPlayLength()."\n";

// author:          Willa Cather
// number of pages: 300
// artist:          The Alabama 3
// play length:     60.33
*/
?>
