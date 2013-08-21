<?php

class woo_domain_Venue {
    private $id;
    private $name;

    function __construct( $id=null, $name ) {
        $this->id = $id;
        $this->name = $name;
    }

    function getId() {
        return $this->id; 
    }

    function getName() {
        return $this->name;
    }

    static function getCollection() {
        return array( 
            new woo_domain_Venue( 1, 'dummy1' )
        );
    }

    static function findAll() {
        return self::getCollection();
    }
}
?>
