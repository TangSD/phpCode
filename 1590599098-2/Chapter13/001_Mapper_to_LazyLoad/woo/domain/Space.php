<?php
require_once( "woo/domain/DomainObject.php" );

class woo_domain_Space extends woo_domain_DomainObject {
    private $name;
    private $events;
    private $venue;

    function __construct( $id=null, $name='main' ) {
        parent::__construct( $id );
        //$this->events = self::getCollection("woo_domain_Event");
        $this->events = null;
        $this->name = $name; 
    }

    function setEvents( woo_domain_EventCollection $events ) {
        $this->events = $events;
    } 

    function getEvents() {
        if ( is_null($this->events) ) {
            $this->events = self::getFinder('woo_domain_Event')
                ->findBySpaceId( $this->getId() );
        }
        return $this->events;
    } 

    function addEvent( woo_domain_Event $event ) {
        $this->events->add( $event );
        $event->setSpace( $this );
    }

    function setName( $name_s ) {
        $this->name = $name_s;
        $this->markDirty();
    }

    function setVenue( woo_domain_Venue $venue ) {
        $this->venue = $venue;
        $this->markDirty();
    }

    function getVenue( ) {
        return $this->venue;
    }

    function getName() {
        return $this->name;
    }
}
?>
