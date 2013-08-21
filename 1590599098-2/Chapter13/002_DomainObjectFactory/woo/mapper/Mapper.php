<?php

require_once("woo/base/Registry.php");
require_once("woo/base/Exceptions.php");
require_once("woo/domain/Finders.php");

abstract class woo_mapper_Mapper implements woo_domain_Finder {
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

    private function getFromMap( $id ) {
        return woo_domain_ObjectWatcher::exists
                ( $this->targetClass(), $id );
    }

    private function addToMap( woo_domain_DomainObject $obj ) {
        return woo_domain_ObjectWatcher::add( $obj );
    }

    function find( $id ) {
        $old = $this->getFromMap( $id );
        if ( $old ) { return $old; }
        $this->selectstmt()->execute( array( $id ) );
        $array = $this->selectstmt()->fetch( ); 
        $this->selectstmt()->closeCursor( );
        if ( ! is_array( $array ) ) { return null; }
        if ( ! isset( $array['id'] ) ) { return null; }
        $object = $this->createObject( $array );
        $object->markClean();
        return $object; 
    }

    function findAll( ) {
        $this->selectAllStmt()->execute( array() );
        return $this->getCollection( $this->selectAllStmt()->fetchAll( PDO::FETCH_ASSOC ) );
    }

    function getFactory() {
        return woo_mapper_PersistenceFactory::getFactory( $this->targetClass() ); 
    } 

    function createObject( $array ) {
        $objfactory = $this->getFactory()->getDomainObjectFactory( );
        return $objfactory->createObject( $array );
    }
 
    function getCollection( array $raw ) {
        return $this->getFactory()->getCollection( $raw );
    }

    function insert( woo_domain_DomainObject $obj ) {
        $this->doInsert( $obj );
        $this->addToMap( $obj );
        $obj->markClean();
    }

//  abstract function update( woo_domain_DomainObject $object );
    protected abstract function doInsert( woo_domain_DomainObject $object );
    protected abstract function targetClass();
    protected abstract function selectStmt( );
    protected abstract function selectAllStmt( );
}
?>
