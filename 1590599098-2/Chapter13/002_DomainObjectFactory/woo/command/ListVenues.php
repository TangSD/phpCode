<?php
require_once( "woo/domain/Venue.php" );

class woo_command_ListVenues extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $collection = woo_domain_Venue::findAll();
        $request->setObject( 'venues', $collection );
        return self::statuses( 'CMD_OK' ); 
    }
}

?>
