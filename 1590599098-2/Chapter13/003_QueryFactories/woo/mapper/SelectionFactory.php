<?php

require_once( "woo/mapper/IdentityObject.php" );

abstract class woo_mapper_SelectionFactory {
    abstract function newSelection( woo_mapper_IdentityObject $obj );

    function buildWhere( woo_mapper_IdentityObject $obj ) {
        if ( $obj->isVoid() ) {
            return array( "", array() );
        } 
        $compstrings = array();
        $values = array();
        foreach ( $obj->getComps() as $comp ) {
            $compstrings[] = "{$comp['name']} {$comp['operator']} ?";
            $values[] = $comp['value'];
        }
        $where = "WHERE " . implode( " AND ", $compstrings );
        return array( $where, $values );
    }
}

?>
