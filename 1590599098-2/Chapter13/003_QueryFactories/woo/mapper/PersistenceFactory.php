<?php
require_once( "woo/mapper/Collections.php" );
require_once( "woo/mapper/DomainObjectFactory.php" );
require_once( "woo/mapper/VenueSelectionFactory.php" );
require_once( "woo/mapper/VenueUpdateFactory.php" );
require_once( "woo/mapper/VenueIdentityObject.php" );
require_once( "woo/mapper/SpaceSelectionFactory.php" );
require_once( "woo/mapper/SpaceUpdateFactory.php" );
require_once( "woo/mapper/VenueIdentityObject.php" );
require_once( "woo/mapper/EventSelectionFactory.php" );
require_once( "woo/mapper/EventUpdateFactory.php" );
require_once( "woo/mapper/EventIdentityObject.php" );

abstract class woo_mapper_PersistenceFactory {

    abstract function getMapper();
    abstract function getDomainObjectFactory();
    abstract function getCollection( array $array );
    abstract function getSelectionFactory();
    abstract function getUpdateFactory();

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

    function getSelectionFactory() {
        return new woo_mapper_VenueSelectionFactory();
    }

    function getUpdateFactory() {
        return new woo_mapper_VenueUpdateFactory();
    }

    function getIdentityObject() {
        return new woo_mapper_VenueIdentityObject();
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

    function getSelectionFactory() {
        return new woo_mapper_SpaceSelectionFactory();
    }

    function getUpdateFactory() {
        return new woo_mapper_SpaceUpdateFactory();
    }

    function getIdentityObject() {
        return new woo_mapper_SpaceIdentityObject();
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

    function getSelectionFactory() {
        return new woo_mapper_EventSelectionFactory();
    }

    function getUpdateFactory() {
        return new woo_mapper_EventUpdateFactory();
    }

    function getIdentityObject() {
        return new woo_mapper_EventIdentityObject();
    }

}

?>
