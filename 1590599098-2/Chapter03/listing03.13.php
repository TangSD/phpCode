<?php
class ShopProduct {
    public $numPages;
    public $playLength;
    public $title;
    public $producerMainName;
    public $producerFirstName;
    public $price;
    public $type;
    
    function __construct(   $title, $firstName, 
                            $mainName, $price, 
                            $numPages=0, $playLength=0, $type ) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
        $this->numPages          = $numPages;
        $this->playLength        = $playLength;
        $this->type              = $type;
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

    function getSummaryLine() {
        $base  = "{$this->title} ( {$this->producerMainName}, ";
        $base .= "{$this->producerFirstName} )";
        if ( $this->type == 'book' ) {
            $base .= ": page count - {$this->numPages}";
        } else if ( $this->type == 'cd' ) {
            $base .= ": playing time - {$this->playLength}";
        }
        return $base;
    }
}

$product1 = new ShopProduct(    "My Antonia", "Willa", "Cather", 5.99, 300, null, 'book' );
$product2 = new ShopProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, null, 60.33, 'cd' );
print $product1->getSummaryLine()."\n";
print $product2->getSummaryLine()."\n";

// outputs:
// My Antonia ( Cather, Willa ): page count - 300
// Exile on Coldharbour Lane ( Alabama 3, The ): playing time - 60.33



// author:          Willa Cather
// number of pages: 300
// artist:          The Alabama 3
// play length:     60.33
?>
