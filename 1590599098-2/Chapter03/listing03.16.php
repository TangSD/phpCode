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

class ShopProductWriter {
    public function write( $shopProduct ) {
        if ( ! ( $shopProduct instanceof CdProduct )  &&
             ! ( $shopProduct instanceof BookProduct ) ) {
            die( "wrong type supplied" );
        }

        $str  = "{$shopProduct->title}: " .
                $shopProduct->getProducer() .
                " ({$shopProduct->price})\n";
        print $str;
    }
}
$product1 = new CdProduct( "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new CdProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, 60.33 );
$writer = new ShopProductWriter();
$writer->write( $product1 ) . "\n";
$writer->write( $product2 ) . "\n";

// output:
// My Antonia: Willa Cather (5.99)
// Exile on Coldharbour Lane: The Alabama 3 (10.99)

// $wrong  = new Wrong();
// $writer->write( $wrong );

?>
