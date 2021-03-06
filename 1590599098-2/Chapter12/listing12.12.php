<?php
abstract class woo_domain_DomainObject {
    private $id;

    function __construct( $id=null ) {
        $this->id = $id;
    }

    function getId( ) {
        return $this->id;
    }

    static function getCollection( $type ) {
        return array(); // dummy
    }
 
    function collection() {
        return self::getCollection( get_class( $this ) );
    }
}

class woo_domain_Venue extends woo_domain_DomainObject {
    private $name;
    private $spaces;

    function __construct( $id=null, $name=null ) {
        $this->name = $name;
        $this->spaces = self::getCollection("woo_domain_Space");
        parent::__construct( $id );
    }

    function setSpaces( woo_domain_SpaceCollection $spaces ) {
        $this->spaces = $spaces;
    }

    function getSpaces() {
        return $this->spaces;
    }

    function addSpace( woo_domain_Space $space ) {
        $this->spaces->add( $space );
        $space->setVenue( $this );
    }

    function setName( $name_s ) {
        $this->name = $name_s;
        $this->markDirty();
    }

    function getName( ) {
        return $this->name;
    }
}

$v = new woo_domain_Venue( null, "The grep and grouch" );
?>
