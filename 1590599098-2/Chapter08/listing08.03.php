<?php
require_once("DB.php");
$dsn_array[] = "mysql://bob:bobs_pass@localhost/bobs_db";
$dsn_array[] = "sqlite://./bobs_db.db";    

foreach ( $dsn_array as $dsn ) {
    $db = DB::connect($dsn);
    if ( DB::isError($db) ) {    
        die ( $db->getMessage() );
    }

    $query_result = $db->query( "SELECT * FROM bobs_table" );

    if ( DB::isError($query_result) ) {    
        die ($query_result->getMessage());
    }

    while ( $row = $query_result->fetchRow( DB_FETCHMODE_ASSOC ) ) {
        print_r( $row );
    }

    $query_result->free();
    $db->disconnect();
}

?>
