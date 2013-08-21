<?php
require_once 'MDB2.php';
$dsn = "mysql://mattz@localhost/test";

$mdb2 = MDB2::connect($dsn);
$query_result = $mdb2->query( "SELECT * FROM bobs_table" );
while ( $row = $query_result->fetchRow( ) ) {
    printf( "| %-4s| %-4s| %-25s|", $row[0], $row[2], $row[1] );
    print "\n";
}

$mdb2->disconnect();
?>
