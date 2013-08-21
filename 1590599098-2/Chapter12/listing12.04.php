<?php

class Registry {
    private static $instance;
    private $values = array();

    private function __construct() { }

    static function instance() {
        if ( ! isset( self::$instance ) ) { self::$instance = new self(); }
        return self::$instance;
    }

    function get( $key ) {
        if ( isset( $this->values[$key] ) ) {
            return $this->values[$key];
        }
        return null;
    }

    function set( $key, $value ) {
        $this->values[$key] = $value;
    }
}

$number = 22;
$reg1 = Registry::instance();
$reg1->set( 'num', $number );
$reg2 = Registry::instance();
print_r( $reg2->get( 'num' ) );
print_r( $reg2->get( 'bum' ) );
?>
