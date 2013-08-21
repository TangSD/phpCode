<?php
require_once( "woo/domain/Collections.php" );
require_once( "woo/domain/ObjectWatcher.php" );
require_once( "woo/domain/HelperFactory.php" );

abstract class woo_domain_DomainObject {
    private $id = -1;

    function __construct( $id=null ) {
        if ( is_null( $id ) ) {
            $this->markNew();
        } else {
            $this->id = $id;
        }
    }

    function markNew() {
        woo_domain_ObjectWatcher::addNew( $this );
    }

    function markDeleted() {
        woo_domain_ObjectWatcher::addDelete( $this );
    }

    function markDirty() {
        woo_domain_ObjectWatcher::addDirty( $this );
    }

    function markClean() {
        woo_domain_ObjectWatcher::addClean( $this );
    }


    function getId( ) {
        return $this->id;
    }

    static function getCollection( $type ) {
        return woo_domain_HelperFactory::getCollection( $type ); 
    }
 
    function collection() {
        return self::getCollection( get_class( $this ) );
    }

    function finder() {
        return self::getFinder( get_class( $this ) );
    }

    static function getFinder( $type ) {
        return woo_domain_HelperFactory::getFinder( $type ); 
    }

    function setId( $id ) {
        $this->id = $id;
    }

    function __clone() {
        $this->id = -1;
    }
}
?>
