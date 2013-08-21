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
        $obj->markClean();
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
        /*
        $ven_mapper = new woo_mapper_VenueMapper();
        $venue = $ven_mapper->find( $array['venue'] );
        $obj->setVenue( $venue );
        */
        
        $factory = woo_mapper_PersistenceFactory::getFactory( 'woo_domain_Venue' );
        $ven_assembler = new woo_mapper_DomainObjectAssembler( $factory );
        $ven_idobj = new woo_mapper_VenueIdentityObject('id');
        $ven_idobj->eq( $array['venue'] );
        $venue = $ven_assembler->findOne( $ven_idobj );

        $factory = woo_mapper_PersistenceFactory::getFactory( 'woo_domain_Event' );
        $event_assembler = new woo_mapper_DomainObjectAssembler( $factory );
        $event_idobj = new woo_mapper_EventIdentityObject('space');
        $event_idobj->eq( $array['id'] );
        $event_collection = $event_assembler->find( $event_idobj );
        $obj->setEvents( $event_collection );
        $obj->markClean();
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
        //$space_mapper = new woo_mapper_SpaceMapper();
        //$space = $space_mapper->findOne( $array['space'] );

        $factory = woo_mapper_PersistenceFactory::getFactory( 'woo_domain_Space' );
        $spc_assembler = new woo_mapper_DomainObjectAssembler( $factory );
        $spc_idobj = new woo_mapper_SpaceIdentityObject('id');
        $spc_idobj->eq( $array['space'] );
        $space = $spc_assembler->findOne( $spc_idobj );


        $obj->setSpace( $space );
        $obj->markClean();
        return $obj;
    }
}

?>
