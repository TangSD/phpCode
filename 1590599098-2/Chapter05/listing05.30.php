<?php
class AcmeShop {
    function getStockArray( ) {
        return array( "socks", "pants" );
    }

    function setDistrictCode( $country, $district ) {
        return "$country, $district\n";
    }

}

class ShopTool {
    private $thirdpartyShop;

    function __construct( AcmeShop $thirdpartyShop ) {
        $this->thirdpartyShop = $thirdpartyShop;
    }

    function __call( $method, $args ) {
        if ( method_exists( $this->thirdpartyShop, $method ) ) {
            return call_user_func_array( 
                        array( $this->thirdpartyShop, $method ), $args );
        }
    }
}

$tool= new ShopTool( new AcmeShop() );
print_r( $tool->setDistrictCode( 'UK', 'BN' ) );
?>
