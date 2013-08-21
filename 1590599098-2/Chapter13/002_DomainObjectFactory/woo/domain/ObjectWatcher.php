<?php
require_once( "woo/base/Registry.php" );

class woo_domain_ObjectWatcher {
    private $all = array();
    private $dirty = array();
    private $new = array();
    private $delete = array();
    private static $instance;

    private function __construct() { }

    static function instance() {
        if ( ! self::$instance ) {
            self::$instance = new woo_domain_ObjectWatcher();
        }
        return self::$instance;
    }
 
    function globalKey( woo_domain_DomainObject $obj ) {
        $key = get_class( $obj ).".".$obj->getId();
        return $key;
    }
  
    static function add( woo_domain_DomainObject $obj ) {
        $inst = self::instance();
        $inst->all[$inst->globalKey( $obj )] = $obj;
    }

    static function exists( $classname, $id ) {
        $inst = self::instance();
        $key = "$classname.$id";
        if ( isset( $inst->all[$key] ) ) {
            return $inst->all[$key];
        }
        return null;
    }
 
    static function addDelete( woo_domain_DomainObject $obj ) {
        $self = self::instance();
        $self->delete[$self->globalKey( $obj )] = $obj;
    }


    static function addDirty( woo_domain_DomainObject $obj ) {
        $inst = self::instance();
        if ( ! in_array( $obj, $inst->new, true ) ) {
            $inst->dirty[$inst->globalKey( $obj )] = $obj;
        }
    }

    static function addNew( woo_domain_DomainObject $obj ) {
        $inst = self::instance();
        // we don't yet have an id
        $inst->new[] = $obj;
    }

    static function addClean(woo_domain_DomainObject $obj ) {
        $self = self::instance();
        unset( $self->delete[$self->globalKey( $obj )] );
        unset( $self->dirty[$self->globalKey( $obj )] );
        if ( in_array( $obj, $self->new, true ) ) {
            $pruned=array();
            foreach ( $self->new as $newobj ) {
                if ( ! ( $newobj === $obj) ) { 
                    $pruned[]=$newobj;
                }
            }  
            $self->new = $pruned;
        }
    }

    function performOperations() {
        foreach ( $this->dirty as $key=>$obj ) {
            $obj->finder()->update( $obj );
        }
        foreach ( $this->new as $key=>$obj ) {
            $obj->finder()->insert( $obj );
        }
        $this->dirty = array();
        $this->new = array();
    } 

/*
    function __destruct() {
        $this->performOperations();
    }
*/
}
