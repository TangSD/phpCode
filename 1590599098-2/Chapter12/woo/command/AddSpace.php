<?php
//require_once( "woo/mapper/VenueMapper.php" );
//require_once( "woo/domain/Venue.php" );

class woo_command_AddSpace extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $venue = $request->getObject( "venue" );
        if ( ! $venue ) {
            $venue = woo_domain_Venue::
                        find($request->getProperty( 'venue_id' ));
        }
        if ( ! $venue ) {
            $request->addFeedback( "unable to find venue" );
            return self::statuses('CMD_ERROR');
        }
        $request->setObject( "venue", $venue );

        $name = $request->getProperty("space_name");

        if ( ! $name ) {
            $request->addFeedback( "please add name for the space" );
            return self::statuses('CMD_INSUFFICIENT_DATA');
        } else {
            $venue->addSpace( $space = new woo_domain_Space( null, $name )); 
            $request->addFeedback( "space '$name' added ({$venue->getId()})" );
            return self::statuses('CMD_OK');
        }
    }
}

?>
