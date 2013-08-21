<?php

class Preferences {
    private $props = array();

    private function __construct() { }

    public function setProperty( $key, $val ) { 
        $this->props[$key] = $val;
    }

    public function getProperty( $key ) { 
        return $this->props[$key];
    }
}

?>
