<?php
    class ShopProduct {
        var $title               = "default product";
        var $producerMainName    = "main name";
        var $producerFirstName   = "first name";
        var $price               = 0;
    }

$product1 = new ShopProduct();

print "{$product1->title}\n";             // default product
print "{$product1->producerMainName}\n";  // main name

?>
