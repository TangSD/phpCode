<?php
require_once( "woo/domain/Collections.php" ); 
require_once( "woo/mapper/Collection.php" ); 
require_once( "woo/domain/Venue.php" ); 

class woo_mapper_VenueCollection 
        extends woo_mapper_Collection
        implements woo_domain_VenueCollection {

    function targetClass( ) {
        return "woo_domain_Venue";
    }
}

class woo_mapper_SpaceCollection 
        extends woo_mapper_Collection
        implements woo_domain_SpaceCollection {

    function targetClass( ) {
        return "woo_domain_Space";
    }
}

class woo_mapper_EventCollection 
        extends woo_mapper_Collection
        implements woo_domain_EventCollection {

    function targetClass( ) {
        return "woo_domain_Event";
    }
}

class woo_mapper_DeferredEventCollection 
        extends woo_mapper_EventCollection {
    private $stmt;
    private $valueArray;
    private $run=false;

    function __construct( woo_mapper_DomainObjectFactory $dofact, PDOStatement $stmt_handle, 
                        array $valueArray ) {
        parent::__construct( null, $dofact ); 
        $this->stmt = $stmt_handle;
        $this->valueArray = $valueArray;
    }

    function notifyAccess() {
        if ( ! $this->run ) {
            $this->stmt->execute( $this->valueArray );
            $this->raw = $this->stmt->fetchAll();
            $this->total = count( $this->raw );
        } 
        $this->run=true;
    }
}

?>
