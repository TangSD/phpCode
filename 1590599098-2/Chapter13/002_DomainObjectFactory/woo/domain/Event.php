<?php
require_once( "woo/domain/DomainObject.php" );

class woo_domain_Event extends woo_domain_DomainObject {
    private $start;
    private $duration;
    private $name;
    private $space;

    function __construct( $id=null, $name="unknown" ) {
        parent::__construct( $id );
        $this->name = $name;
    }

    function setStart( $start_l ) {
        $this->start = $start_l;
    }

    function getStart( ) {
        return $this->start;
    }

    function setSpace( woo_domain_Space $space ) {
        $this->space = $space;
        $this->markDirty();
    }

    function getSpace( ) {
        return $this->space;
    }

    function setDuration( $duration_i ) {
        $this->duration = $duration_i;
        $this->markDirty();
    }
    
    function getDuration() {
        return $this->duration;
    }

    function setName( $name_s ) {
        $this->name = $name_s;
        $this->markDirty();
    }
    
    function getName() {
        return $this->name;
    }
}
?>
