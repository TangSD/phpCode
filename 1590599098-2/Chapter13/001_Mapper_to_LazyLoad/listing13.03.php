<?php
require_once( "woo/domain/HelperFactory.php" );
$collection = woo_domain_HelperFactory::getCollection("woo_domain_Venue");
$collection->add( new woo_domain_Venue( null, "Loud and Thumping" ) );
$collection->add( new woo_domain_Venue( null, "Eeezy" ) );
$collection->add( new woo_domain_Venue( null, "Duck and Badger" ) );

foreach( $collection as $venue ) {
    print $venue->getName()."\n";
}
?>
