<?php

interface woo_domain_Finder {
    function find( $id );
    function findAll();

    function update( woo_domain_DomainObject $object );
    function insert( woo_domain_DomainObject $obj );
    //function delete();
}

interface woo_domain_SpaceFinder extends woo_domain_Finder { 
    function findByVenue( $id );
}

interface woo_domain_VenueFinder  extends woo_domain_Finder { 
}

interface woo_domain_EventFinder  extends woo_domain_Finder { 
}
?>
