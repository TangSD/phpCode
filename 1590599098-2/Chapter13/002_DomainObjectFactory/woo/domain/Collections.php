<?php

interface woo_domain_VenueCollection extends Iterator {
    function add( woo_domain_DomainObject $venue );
}

interface woo_domain_SpaceCollection extends Iterator {
    function add( woo_domain_DomainObject $space );
}

interface woo_domain_EventCollection extends Iterator {
    function add( woo_domain_DomainObject $event );
}

?>
