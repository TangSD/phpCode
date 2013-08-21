<?php

require_once("woo/base/Registry.php");
require_once("woo/base/Exceptions.php");
//require_once("woo/domain/Finders.php");

abstract class woo_mapper_Mapper {
    protected static $PDO; 
    function __construct() {
 
        if ( ! isset(self::$PDO) ) { 
            $dsn = woo_base_ApplicationRegistry::getDSN( );
            if ( is_null( $dsn ) ) {
                throw new woo_base_AppException( "No DSN" );
            }
            self::$PDO = new PDO( $dsn );
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    function find( $id ) {
        $this->selectstmt()->execute( array( $id ) );
        $array = $this->selectstmt()->fetch( ); 
        $this->selectstmt()->closeCursor( ); 
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        return $object; 
    }

    function createObject( $array ) {
        $obj = $this->doCreateObject( $array );
        return $obj;
    }

    function insert( woo_domain_DomainObject $obj ) {
        $this->doInsert( $obj );
    }

    abstract function update( woo_domain_DomainObject $object );
    protected abstract function doCreateObject( array $array );
    protected abstract function doInsert( woo_domain_DomainObject $object );
    protected abstract function selectStmt();
}

?>
