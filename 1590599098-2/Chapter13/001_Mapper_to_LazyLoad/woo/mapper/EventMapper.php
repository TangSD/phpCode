<?php

require_once( "woo/base/Exceptions.php" );
require_once( "woo/mapper/Mapper.php" );
require_once( "woo/mapper/Collections.php" );
require_once( "woo/domain.php" );

class woo_mapper_EventMapper extends woo_mapper_Mapper 
                             implements woo_domain_EventFinder {

    function __construct() {
        parent::__construct();
        $this->selectAllStmt = self::$PDO->prepare(
                            "SELECT * FROM event");
        $this->selectBySpaceStmt = self::$PDO->prepare(
                            "SELECT * FROM event where space=?");
        $this->selectStmt = self::$PDO->prepare(
                            "SELECT * FROM event WHERE id=?");
        $this->updateStmt = self::$PDO->prepare(
                            "UPDATE event SET start=?, duration=?, name=?, id=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
                            "INSERT into event (start, duration, space, name) 
                             values( ?, ?, ?, ?)");
    } 
    
    function getCollection( array $raw ) {
        return new woo_mapper_EventCollection( $result->fetchAll(), $this );
    }

    function findBySpaceId( $s_id ) {
        return new woo_mapper_DeferredEventCollection( 
                    $this, $this->selectBySpaceStmt, array( $s_id ) );
    }

    protected function doCreateObject( array $array ) {
        $obj = new woo_domain_Event( $array['id'] );
        $obj->setstart( $array['start'] );
        $obj->setduration( $array['duration'] );
        $obj->setname( $array['name'] );
        $space_mapper = new woo_mapper_SpaceMapper();
        $space = $space_mapper->find( $array['space'] );
        $obj->setSpace( $space );

        return $obj;
    }

    protected function targetClass() {
        return "woo_domain_Event";
    }

    protected function doInsert( woo_domain_DomainObject $object ) {
        $space = $object->getSpace();
        if ( ! $space ) { 
            throw new woo_base_AppException( "cannot save without space" );
        }

        $values = array( $object->getstart(), $object->getduration(), $space->getId(), $object->getname() ); 
        $this->insertStmt->execute( $values );
    }
    
    function update( woo_domain_DomainObject $object ) {
        $values = array( $object->getstart(), $object->getduration(), $object->getname(), $object->getid(), $object->getId() ); 
        $this->updateStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }

    function selectAllStmt() {
        return $this->selectAllStmt;
    }

}
?>
