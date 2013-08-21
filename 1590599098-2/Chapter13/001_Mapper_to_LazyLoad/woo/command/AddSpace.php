<?php
//require_once( "woo/mapper/VenueMapper.php" );
require_once( "woo/domain/Venue.php" );

class woo_command_AddSpace extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $venue = $request->getObject( "venue" );
        if ( ! isset( $venue ) ) {
            $venue = woo_domain_Venue::
                        find($request->getProperty( 'venue_id' ));
        }
        if ( is_null( $venue ) ) {
            $request->addFeedback( "unable to find venue" );
            return self::statuses('CMD_ERROR');
        }
        $request->setObject( "venue", $venue );

        $name = $request->getProperty("space_name");

        if ( ! isset( $name ) ) {
            $request->addFeedback( "please add name for the space" );
            return self::statuses('CMD_INSUFFICIENT_DATA');
        } else {
            $venue->addSpace( $space = new woo_domain_Space( null, $name )); 
        //    woo_domain_ObjectWatcher::instance()->performOperations();
            //$space->finder()->insert( $space );
            $request->addFeedback( "space '$name' added ({$space->getId()})" );
            return self::statuses('CMD_OK');
        }
    }
}

?>
