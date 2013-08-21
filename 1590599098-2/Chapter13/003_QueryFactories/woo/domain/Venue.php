<?php
require_once( "woo/domain/DomainObject.php" );
require_once( "woo/mapper/SpaceIdentityObject.php" );

class woo_domain_Venue extends woo_domain_DomainObject {
    private $name;
    private $spaces;

    function __construct( $id=null, $name=null ) {
        $this->name = $name;
        parent::__construct( $id );
    }
    
    function setSpaces( woo_domain_SpaceCollection $spaces ) {
        $this->spaces = $spaces;
    } 

    function getSpaces() {
        if ( ! isset( $this->spaces ) ) {
            $finder = self::getFinder( 'woo_domain_Space' ); 
            $idobj = new woo_mapper_SpaceIdentityObject('venue');
            $this->spaces = $finder->find( $idobj->eq( $this->getId() ) );
        }
        return $this->spaces;
    } 

    function addSpace( woo_domain_Space $space ) {
        $this->getSpaces()->add( $space );
        $space->setVenue( $this );
    }

    function setName( $name_s ) {
        $this->name = $name_s;
        $this->markDirty();
    }

    function getName( ) {
        return $this->name;
    }
    
    static function findAll() {
        $finder = self::getFinder( __CLASS__ ); 
        $idobj = new woo_mapper_VenueIdentityObject( );
        return $finder->find( $idobj );
    }
    static function find( $id ) {
        $finder = self::getFinder( __CLASS__ ); 
        $idobj = new woo_mapper_VenueIdentityObject( 'id' );
        return $finder->findOne( $idobj->eq( $id ) );
    }

}

?>
