<?php

class woo_base_AppException extends Exception {}

class woo_base_DBException extends Exception {
    private $error;
    function __construct( DB_Error $error ) {
        parent::__construct( $error->getMessage(), $error->getCode() ); 
        $this->error = $db_error;
    }

    function getErrorObject() {
        return $this->error;
    }

}


?>
