<?php

abstract class ApptEncoder {
    abstract function encode();
}

abstract class TtdEncoder {
    abstract function encode();
}

abstract class ContactEncoder {
    abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {
    function encode() {
        return "Appointment data encoded in BloggsCal format\n";
    }
}

class BloggsContactEncoder extends ContactEncoder {
    function encode() {
        return "Contact data encoded in BloggsCal format\n";
    }
}

class BloggsTtdEncoder extends ApptEncoder {
    function encode() {
        return "Things to do data encoded in BloggsCal format\n";
    }
}

class MegaApptEncoder extends ApptEncoder {
    function encode() {
        return "Appointment data encoded in MegaCal format\n";
    }
}

abstract class CommsManager {
    const APPT    = 1;
    const TTD     = 2;
    const CONTACT = 3;
    abstract function getHeaderText();
    abstract function make( $flag_int );
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {
    function getHeaderText() {
        return "BloggsCal header\n";
    }

    function make( $flag_int ) {
        switch ( $flag_int ) {
            case self::APPT:
                return new BloggsApptEncoder();
            case self::CONTACT:
                return new BloggsContactEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
        } 
    }

    function getFooterText() {
        return "BloggsCal footer\n";
    }
}

$comms = new BloggsCommsManager();
print $comms->getHeaderText();
print $comms->make( CommsManager::APPT )->encode();
print $comms->make( CommsManager::TTD )->encode();
print $comms->make( CommsManager::CONTACT )->encode();
print $comms->getFooterText();

?>
