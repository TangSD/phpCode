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

class MegaContactEncoder extends ContactEncoder {
    function encode() {
        return "Contact data encoded in MegaCal format\n";
    }
}

class MegaTtdEncoder extends ApptEncoder {
    function encode() {
        return "Things to do data encoded in MegaCal format\n";
    }
}

abstract class CommsManager {
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getTtdEncoder();
    abstract function getContactEncoder();
    abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager {
    function getHeaderText() {
        return "BloggsCal header\n";
    }

    function getApptEncoder() {
        return new BloggsApptEncoder(); 
    }

    function getTtdEncoder() {
        return new BloggsTtdEncoder(); 
    }

    function getContactEncoder() {
        return new BloggsContactEncoder(); 
    }

    function getFooterText() {
        return "BloggsCal footer\n";
    }
}

class MegaCommsManager extends CommsManager {
    function getHeaderText() {
        return "MegaCal header\n";
    }

    function getApptEncoder() {
        return new MegaApptEncoder(); 
    }

    function getTtdEncoder() {
        return new MegaTtdEncoder(); 
    }

    function getContactEncoder() {
        return new MegaContactEncoder(); 
    }

    function getFooterText() {
        return "MegaCal footer\n";
    }
}

?>
