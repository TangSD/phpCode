<?php
require_once("woo/mapper/IdentityObject.php");

class woo_mapper_EventIdentityObject extends woo_mapper_IdentityObject {
    function __construct( $field=null ) {
       parent::__construct( $field, array('name', 'id','start','duration',  'space' ) ); 
    }
}
/*
$idobj = new woo_mapper_EventIdentityObject();
$idobj->field("name")->eq("The Good Show")
      ->field("banana")->gt( time() )
                      ->lt( time()+(24*60*60) )
      ->getComps();

*/
?>
