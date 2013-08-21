<?php
require_once( "woo/domain/Venue.php" );

class woo_command_ListVenues extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $collection = woo_domain_Venue::findAll();
        $request->setObject( 'venues', $collection );

        $factory = woo_mapper_PersistenceFactory::getFactory( 'woo_domain_Venue' );
        $finder = new woo_mapper_DomainObjectAssembler( $factory );
        $idobj = $factory->getIdentityObject()->field('name')->eq('The Eyeball Inn');
        $collection = $finder->find( $idobj );
        foreach ( $collection as $venue ) {
            print_r( $venue );
        }
        
        die;

        return self::statuses( 'CMD_OK' ); 
    }
}

?>
