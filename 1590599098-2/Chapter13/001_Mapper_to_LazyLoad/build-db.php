<?php

die("this is dogfood - a cheap and cheerful script to set up \n".
    "data for my examples. Use at your peril.\n");
/*
 set up script for transaction script example
 this is dogfood
*/


class DBFace {
    private $pdo;
    function __construct( $dsn, $user=null, $pass=null ) {
        $this->pdo = new PDO( $dsn, $user, $pass );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    function query( $query ) {
        try {
            $stmt = $this->pdo->query( $query );
            return $stmt;
        } catch ( Exception $e ) {
            print $e->getMessage()."\n";
            return null;
        }
    }
}

$mode="sqlite";

if ( $mode == 'mysql' ) {
    $autoincrement = "AUTO_INCREMENT";
    $dsn = "mysql:dbname=test";    
} else {
    $dsn = "sqlite://tmp/data/woo.db";    
    $autoincrement = "AUTOINCREMENT";
}
$db=new DBFace($dsn);
$db->query( "DROP TABLE venue" );
$db->query( "CREATE TABLE venue ( id INTEGER PRIMARY KEY $autoincrement, name TEXT )" );

$db->query( "DROP TABLE space" );
$db->query( "CREATE TABLE space ( id INTEGER PRIMARY KEY $autoincrement, venue INTEGER, name TEXT )" ); 
$db->query( "DROP TABLE event" );
$db->query( "CREATE TABLE event ( id INTEGER PRIMARY KEY $autoincrement, space INTEGER, start long, duration int, name text )" );
?>
