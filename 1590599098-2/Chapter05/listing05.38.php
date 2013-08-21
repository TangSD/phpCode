<?php

class Person {
    public $name;
    function __construct( $name ) {
        $this->name = $name;
        print "Person constructed with $name\n";
    }
}

interface Module {
    function execute();
}

class FtpModule implements Module {
    function setHost( $host ) {
        print "FtpModule::setHost(): $host\n";
    }

    function setUser( $user ) {
        print "FtpModule::setUser(): $user\n";
    }

    function execute() {
        // do things
    }
}

class PersonModule implements Module {
    function setPerson( Person $person ) {
        print "PersonModule::setPerson(): {$person->name}\n";
    }
    
    function execute() {
        // do things
    }
}

?>
