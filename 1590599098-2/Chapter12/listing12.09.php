<?php
require_once("woo/base/Registry.php");
require_once("woo/controller/Request.php");

abstract class woo_controller_PageController {
    private $request;
    function __construct() {
        $request = woo_base_RequestRegistry::getRequest();
        if ( is_null( $request ) ) { $request = new woo_controller_Request(); }
        $this->request = $request;
    }

    abstract function process();

    function forward( $resource ) {
        include( $resource );
        exit( 0 );
    }

    function getRequest() {
        return $this->request;
    }
}

class woo_controller_AddVenueController extends woo_controller_PageController {
    function process() {
        try {
            $request = $this->getRequest();
            $name = $request->getProperty( 'venue_name' );
            if ( is_null( $request->getProperty('submitted') ) ) {
               $request->addFeedback("choose a name for the venue");
               $this->forward( 'add_venue.php' );
            } else if ( is_null( $name ) ) {
               $request->addFeedback("name is a required field");
               $this->forward( 'add_venue.php' );
            }
            $venue = new woo_domain_Venue( null, $name );
            $this->forward( "ListVenues.php" );
        } catch ( Exception $e ) {
            $this->forward( 'error.php' );
        }
    }
}
$controller = new woo_controller_AddVenueController();
$controller->process();
?>
