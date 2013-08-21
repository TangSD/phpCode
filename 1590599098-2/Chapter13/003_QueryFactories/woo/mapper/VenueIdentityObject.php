<?php
require_once("woo/mapper/IdentityObject.php");

class woo_mapper_VenueIdentityObject extends woo_mapper_IdentityObject {
    function __construct( $field=null ) {
       parent::__construct( $field, array('name', 'id' ) ); 
    }
}

?>
