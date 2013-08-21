<?php
require_once( "woo/mapper/DomainObjectAssembler.php" );
require_once( "woo/mapper/PersistenceFactory.php" );
require_once( "woo/mapper/IdentityObject.php" );
require_once( "woo/mapper/VenueIdentityObject.php" );

$assembler = new woo_mapper_DomainObjectAssembler( woo_mapper_PersistenceFactory::getFactory("woo_domain_Venue" ) );
$venue_io=new woo_mapper_VenueIdentityObject();
//$venue_io->field("name")->eq("blah")
//         ->add( "id" )->lt( 40 );

//$venue_io->field( "id" )->lt( 40 )->add("name")->eq("one-venue");
//$venue_io->output();
//$venue_io->setName("blah");
//$venue_io->setMinimumId(40);
$venues = $assembler->find($venue_io); 
foreach( $venues as $venue ) {
    print $venue->getName()."\n";
}
?>
