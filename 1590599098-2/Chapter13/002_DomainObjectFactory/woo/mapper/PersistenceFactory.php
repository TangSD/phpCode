<?php
require_once( "woo/mapper/Collections.php" );
require_once( "woo/mapper/DomainObjectFactory.php" );

abstract class woo_mapper_PersistenceFactory {

    abstract function getMapper();
    abstract function getDomainObjectFactory();
    abstract function getCollection( array $array );

    static function getFactory( $target_class ) {
        switch ( $target_class ) {
            case "woo_domain_Venue";
                return new woo_mapper_VenuePersistenceFactory();
                break;
            case "woo_domain_Event";
                return new woo_mapper_EventPersistenceFactory();
                break;
            case "woo_domain_Space";
                return new woo_mapper_SpacePersistenceFactory();
                break;
        }
    }
}

class woo_mapper_VenuePersistenceFactory extends woo_mapper_PersistenceFactory {
    function getMapper() {
        return new woo_mapper_VenueMapper();
    }

    function getDomainObjectFactory() {
        return new woo_mapper_VenueObjectFactory();
    }

    function getCollection( array $array ) {
        return new woo_mapper_VenueCollection( $array, $this->getDomainObjectFactory() );
    }
}

class woo_mapper_SpacePersistenceFactory extends woo_mapper_PersistenceFactory {
    function getMapper() {
        return new woo_mapper_SpaceMapper();
    }

    function getDomainObjectFactory() {
        return new woo_mapper_SpaceObjectFactory();
    }

    function getCollection( array $array ) {
        return new woo_mapper_SpaceCollection( $array, $this->getDomainObjectFactory() );
    }
}

class woo_mapper_EventPersistenceFactory extends woo_mapper_PersistenceFactory {
    function getMapper() {
        return new woo_mapper_EventMapper();
    }

    function getDomainObjectFactory() {
        return new woo_mapper_EventObjectFactory();
    }

    function getCollection( array $array ) {
        return new woo_mapper_EventCollection( $array, $this->getDomainObjectFactory() );
    }
}

?>
