<?php
    class ShopProduct {
        public $title               = "default product";
        public $producerMainName    = "main name";
        public $producerFirstName   = "first name";
        public $price               = 0;
    }

$product1 = new ShopProduct();

print "{$product1->title}\n";             // default product
print "{$product1->producerMainName}\n";  // main name

?>
