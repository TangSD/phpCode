<?php
//require_once( "woo/mapper/VenueMapper.php" );
require_once( "woo/domain/Venue.php" );

class woo_command_AddVenue extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $name = $request->getProperty("venue_name");
        if ( ! $name ) {
            $request->addFeedback( "no name provided" );
            return self::statuses('CMD_INSUFFICIENT_DATA');
        } else {
            $venue_obj = new woo_domain_Venue( null, $name ); 
            $request->setObject( 'venue', $venue_obj );
            $request->addFeedback( "'$name' added ({$venue_obj->getId()})" );
            return self::statuses('CMD_OK');
        }
        return self::statuses('CMD_DEFAULT');
    }
}

?>
