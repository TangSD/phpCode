<?php
die("this is dogfood - a cheap and cheerful script to set up \n".
    "data for my examples. Use at your peril.\n");

require_once 'MDB2.php';
// this is yet more dogfood to set up data for the book
// requires a mysql instance on localhost with an open
// test database

$here =dirname(__FILE__);
$dsn[] = "mysql://mattz@localhost/test";
$table = "bobs_table";
$create =   "CREATE TABLE $table (  id INT PRIMARY KEY, 
                                    lesson_name varchar(255), 
                                    duration    int )";
$insert = array(    
            array( "id"=>1, "lesson_name" => "applied doodads", 
                   "duration"    => 3 ),
            array( "id"=>2, "lesson_name" => "how to spam", 
                   "duration"    => 2 ),
);


$options = array();
foreach ( $dsn as $str ) {
    print "$str\n";
    $mdb2 = MDB2::connect($str);
    $res = $mdb2->query( "DROP TABLE $table" );
    $res = $mdb2->query( $create );
    if (PEAR::isError($res)) {
        die($res->getMessage());
    }
    $prep = $mdb2->prepare("INSERT INTO $table (lesson_name, duration, id) VALUES (?, ?, ?)"); 
    foreach ( $insert as $row ) {                    
        $res = $prep->execute( array( $row['lesson_name'], $row['duration'], $row['id'] ) );
        if (PEAR::isError($res)) {
            die($res->getMessage());
        }
    }
    $mdb2->disconnect();
}
?>
