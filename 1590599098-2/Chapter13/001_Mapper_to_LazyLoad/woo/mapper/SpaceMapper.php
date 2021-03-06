<?php

require_once( "woo/base/Exceptions.php" );
require_once( "woo/mapper/Mapper.php" );
require_once( "woo/mapper/VenueMapper.php" );
require_once( "woo/mapper/Collections.php" );
require_once( "woo/domain.php" );

class woo_mapper_SpaceMapper extends woo_mapper_Mapper 
                             implements woo_domain_SpaceFinder {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = self::$PDO->prepare(
                            "SELECT * FROM space");
        $this->selectStmt = self::$PDO->prepare(
                            "SELECT * FROM space WHERE id=?");
        $this->updateStmt = self::$PDO->prepare(
                            "UPDATE space SET name=?, id=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
                            "INSERT into space ( name, venue ) 
                             values( ?, ?)");
        $this->findByVenueStmt = self::$PDO->prepare(
                            "SELECT * FROM space where venue=?");
    } 
    
    function getCollection( array $raw ) {
        return new woo_mapper_SpaceCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new woo_domain_Space( $array['id'] );
        $obj->setname( $array['name'] );
        $ven_mapper = new woo_mapper_VenueMapper();
        $venue = $ven_mapper->find( $array['venue'] );
        $obj->setVenue( $venue );

        $event_mapper = new woo_mapper_EventMapper();
        $event_collection = $event_mapper->findBySpaceId( $array['id'] );        
        $obj->setEvents( $event_collection );
        return $obj;
    }

    protected function targetClass() {
        return "woo_domain_Space";
    }

    protected function doInsert( woo_domain_DomainObject $object ) {
        $venue = $object->getVenue();
        if ( ! $venue ) { 
            throw new woo_base_AppException( "cannot save without venue" );
        }
        $values = array( $object->getname(), $venue->getId() ); 
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

    # custom
    function findByVenue( $vid ) {
        $this->findByVenueStmt->execute( array( $vid ) );
        return new woo_mapper_SpaceCollection( $this->findByVenueStmt->fetchAll(), $this );
    }
    # end_custom
}
