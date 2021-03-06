<?php

class woo_mapper_IdentityObject {
    private $name = null;
    function setName( $name ) {
        $this->name=$name;
    }

    function getName() {
        return $this->name;
    }
}

class woo_mapper_EventIdentityObject 
    extends woo_mapper_IdentityObject {
    private $start = null;
    private $minstart = null;

    function setMinimumStart( $minstart ) {
        $this->minstart = $minstart;
    }
    function getMinimumStart() {
        return $this->minstart;
    }

    function setStart( $start ) {
        $this->start = $start;
    }
    function getStart() {
        return $this->start;
    }
}

$idobj = new woo_mapper_EventIdentityObject();
$idobj->setMinimumStart( time() );
$idobj->setName( "A Fine Show" );

$comps = array();
$name = $idobj->getName(); 
if ( ! is_null( $name ) ) {
    $comps[] = "name = '{$name}'";
}
$minstart = $idobj->getMinimumStart(); 
if ( ! is_null( $minstart ) ) {
    $comps[] = "start > {$minstart}";
}

$start = $idobj->getStart(); 
if ( ! is_null( $start ) ) {
    $comps[] = "start = '{$start}'";
}

$clause = " WHERE " . implode( " and ", $comps );

print $clause;

?>
