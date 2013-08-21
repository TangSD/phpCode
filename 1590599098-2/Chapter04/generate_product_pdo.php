<?php
die("this is dogfood - a cheap and cheerful script to set up \n".
    "data for my examples. Use at your peril.\n");

// private class
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

// creates sample data and returns a PDO object
function getPDO() {
    $create_products = "CREATE TABLE products ( 
                            id INTEGER PRIMARY KEY AUTOINCREMENT, 
                            type TEXT,
                            firstname TEXT,
                            mainname TEXT,
                            title TEXT,
                            price float,
                            numpages int,
                            playlength int,
                            discount int )";
    $path = dirname(__FILE__)."/products.db";
    // destroy db left over from previous example
    unlink( $path );
    $dsn = "sqlite:/$path";    
    $pdo = new PDO( $dsn, null, null );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query( $create_products );
    $pdo->query( "INSERT INTO products ( type, firstname, mainname, title, price, numpages, playlength, discount ) 
                                values ( 'book', 'willa', 'cather', 'my antonia', 4.22, 200, NULL, 0 )");
    $pdo->query( "INSERT INTO products ( type, firstname, mainname, title, price, numpages, playlength, discount ) 
                                values ( 'cd', 'the', 'clash', 'london calling', 4.22, 200, 60, 0 )");
    $pdo->query( "INSERT INTO products ( type, firstname, mainname, title, price, numpages, playlength, discount ) 
                                values ( 'shop', NULL, 'pears', 'soap', 4.22, NULL, NULL, 0 )");
    return $pdo;
}
?>
