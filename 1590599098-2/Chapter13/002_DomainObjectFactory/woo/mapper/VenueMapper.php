<?php

require_once( "woo/mapper/Mapper.php" );
require_once( "woo/mapper/PersistenceFactory.php" );
require_once( "woo/base/Exceptions.php" );
require_once( "woo/mapper/Collections.php" );
require_once( "woo/domain.php" );

class woo_mapper_VenueMapper extends woo_mapper_Mapper 
                             implements woo_domain_VenueFinder {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = self::$PDO->prepare( 
                            "SELECT * FROM venue");
        $this->selectStmt = self::$PDO->prepare( 
                            "SELECT * FROM venue WHERE id=?");
        $this->updateStmt = self::$PDO->prepare( 
                            "UPDATE venue SET name=?, id=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare( 
                            "INSERT into venue ( name ) 
                             values( ? )");
    } 
    
    protected function targetClass() {
        return "woo_domain_Venue";
    }

    protected function doInsert( woo_domain_DomainObject $object ) {
        $values = array( $object->getname() ); 
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }
    
    function update( woo_domain_DomainObject $object ) {
        $values = array( $object->getname(), $object->getid(), $object->getId() ); 
        $this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }

    function selectAllStmt() {
        return $this->selectAllStmt;
    }

}
