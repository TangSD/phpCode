<?php

class Contained { 
    public $now = 5;
}

class Container {
    public $contained;
    function __construct() {
        $this->contained = new Contained();
    }

    function __clone() {
        // Ensure that cloned object holds a 
        // clone of self::$contained and not
        // a reference to it
        $this->contained = clone $this->contained;
    }
}

$original = new Container();
$copy = clone $original;
$original->contained->now = -1;
print_r( $original );
print_r( $copy );
?>
