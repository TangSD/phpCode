<?php
class AcmeShop {
    function getStockArray( ) {
        return array( "socks", "pants" );
    }
}

class ShopTool {
    private $thirdpartyShop;

    function __construct( AcmeShop $thirdpartyShop ) {
        $this->thirdpartyShop = $thirdpartyShop;
    }

    function __call( $method, $args ) {
        if ( method_exists( $this->thirdpartyShop, $method ) ) {
            return $this->thirdpartyShop->$method( );
        }
    }
}

$tool= new ShopTool( new AcmeShop() );
print_r( $tool->getStockArray() );
?>
