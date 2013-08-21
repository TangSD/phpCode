<?php

class ObjectWriter {}
class MyLister {

    function setArray( array $storearray ) {
        $this->array = $storearray;
    }
    function setWriter( ObjectWriter $objwriter=null ) {
        $this->writer = $objwriter;
    }
}

$x = new MyLister();
$x->setArray( array(1, 2) );

$writer = new ObjectWriter();
$x->setWriter( $writer );
?>
