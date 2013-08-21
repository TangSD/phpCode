<?php
require_once("woo/mapper/SelectionFactory.php");
require_once("woo/mapper/VenueIdentityObject.php");

class woo_mapper_VenueSelectionFactory extends woo_mapper_SelectionFactory {

    function newSelection( woo_mapper_IdentityObject $obj ) {
        $fields = implode( ',', $obj->getObjectFields() );
        $core = "SELECT $fields FROM venue";
        list( $where, $values ) = $this->buildWhere( $obj );
        return array( $core." ".$where, $values );
    }

}
?>
