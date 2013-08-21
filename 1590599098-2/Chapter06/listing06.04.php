<?php
include_once( "ShopProduct.php" );

    function workWithProducts( ShopProduct $prod ) {
        if ( get_class( $prod ) == "CdProduct" ) {
            // do cd thing
            print "cd\n";
        } else if ( get_class( $prod ) == "BookProduct" ) {
            // do book thing
            print "book\n";
        }
    }

workWithProducts( new CdProduct( "Exile on Coldharbour Lane", "The", "Alabama 3", 10.99, 60.33 ) );
workWithProducts( new BookProduct( "Catch 22", "Joseph", "Heller", 10.99, 200 ) );

?>
