<?php
require_once( "woo/mapper/UpdateFactory.php");

class woo_mapper_SpaceUpdateFactory extends woo_mapper_UpdateFactory {

    function newUpdate( woo_domain_DomainObject $obj ) {
        // not type checking removed
        $id = $obj->getId();
        $cond = null; 
        $values['name'] = $obj->getName();
        $values['venue'] = $obj->getVenue()->getId();

        if ( $id > -1 ) {
            $cond['id'] = $id;
        }
        return $this->buildStatement( "space", $values, $cond );
    }
}
?>
