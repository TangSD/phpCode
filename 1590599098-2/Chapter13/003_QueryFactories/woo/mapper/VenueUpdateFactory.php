<?php
require_once( "woo/mapper/UpdateFactory.php");

class woo_mapper_VenueUpdateFactory extends woo_mapper_UpdateFactory {

    function newUpdate( woo_domain_DomainObject $obj ) {
        // not type checking removed
        $id = $obj->getId();
        $cond = null; 
        $values['name'] = $obj->getName();
        if ( $id > -1 ) {
            $cond['id'] = $id;
        }
        return $this->buildStatement( "venue", $values, $cond );
    }

}
?>
