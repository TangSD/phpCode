<?php
require_once( "listing12.05.php" ); // Registry

/*
// test mem app registry
if ( ! isset( $argv[1] ) ) {
    // run script without argument to monitor
    while ( 1 ) {
        sleep(5);
        $thing = woo_base_MemApplicationRegistry::getDSN();
        print "dsn is {$thing}\n";
    }
} else {
    // run script with argument in separate window to change value.. see the result in monitor process
    print "setting dsn {$argv[1]}\n"; 
    woo_base_MemApplicationRegistry::setDSN($argv[1]);
}
*/

// test file app registry
if ( ! isset( $argv[1] ) ) {
    // run script without argument to monitor
    while ( 1 ) {
        sleep(5);
        $thing = woo_base_ApplicationRegistry::getDSN();
        print "dsn is {$thing}\n";
    }
} else {
    // run script with argument in separate window to change value.. see the result in monitor process
    print "setting dsn {$argv[1]}\n"; 
    woo_base_ApplicationRegistry::setDSN($argv[1]);
}

?>
