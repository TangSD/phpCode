<?php
class AddressManager {
    function __construct() {
        $this->addresses = array( "216.109.112.135", "64.233.187.99" );
    }

    function outputAddresses( $resolve ) {
        if ( is_string( $resolve ) ) {
           $resolve = ( preg_match("/false|no|off/i", $resolve ) )?
                 false:true;
        }
        foreach ( $this->addresses as $address ) {
            print $address;
            if ( $resolve ) {
                print " (".gethostbyaddr( $address ).")";
            }
            print "\n";
        }
    }
}

$settings = simplexml_load_file("settings.xml");
$manager = new AddressManager();
$manager->outputAddresses( (string)$settings->resolvedomains );
?>
