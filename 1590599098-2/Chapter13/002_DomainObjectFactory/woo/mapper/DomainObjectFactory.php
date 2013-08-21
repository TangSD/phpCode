<?php

abstract class woo_mapper_DomainObjectFactory {
    abstract function createObject( array $array );

    protected function getFromMap( $class, $id ) {
        return woo_domain_ObjectWatcher::exists( $class, $id );
    }

    protected function addToMap( woo_domain_DomainObject $obj ) {
        return woo_domain_ObjectWatcher::add( $obj );
    }

}

class woo_mapper_VenueObjectFactory extends woo_mapper_DomainObjectFactory {
    function createObject( array $array ) {
        $class = 'woo_domain_Venue';
        $old = $this->getFromMap( $class, $array['id'] );
        if ( $old ) { return $old; }
        $obj = new $class( $array['id'] );
        $obj->setname( $array['name'] );
        //$space_mapper = new woo_mapper_SpaceMapper();
        //$space_collection = $space_mapper->findByVenue( $array['id'] );
        //$obj->setSpaces( $space_collection );
        $this->addToMap( $obj );
        return $obj;
    }
}

class woo_mapper_SpaceObjectFactory extends woo_mapper_DomainObjectFactory {
    function createObject( array $array ) {
        $class = 'woo_domain_Space';
        $old = $this->getFromMap( $class, $array['id'] );
        if ( $old ) { return $old; }
        $obj = new $class( $array['id'] );
        $obj->setname( $array['name'] );
        $ven_mapper = new woo_mapper_VenueMapper();
        $venue = $ven_mapper->find( $array['venue'] );
        $obj->setVenue( $venue );

        $event_mapper = new woo_mapper_EventMapper();
        $event_collection = $event_mapper->findBySpaceId( $array['id'] );        
        $obj->setEvents( $event_collection );
        return $obj;
    }
}

class woo_mapper_EventObjectFactory extends woo_mapper_DomainObjectFactory {
    function createObject( array $array ) {
        $class = 'woo_domain_Event';
        $old = $this->getFromMap( $class, $array['id'] );
        $obj = new $class( $array['id'] );
        $obj->setstart( $array['start'] );
        $obj->setduration( $array['duration'] );
        $obj->setname( $array['name'] );
        $space_mapper = new woo_mapper_SpaceMapper();
        $space = $space_mapper->find( $array['space'] );
        $obj->setSpace( $space );

        return $obj;
    }
}

?>
