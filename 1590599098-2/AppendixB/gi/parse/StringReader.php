<?php

/**
 * A string based implementation of {@link r3_parse_Reader}
 *
 *
 * Copyright (c) 2007 Yahoo! Inc.  All rights reserved.
 * The copyrights embodied in the content of this file are licensed under the BSD
 * open source license
 *
 * @package r3
 * @subpackage parse
 * @author Matt Zandstra <zandstra@yahoo-inc.com>
 * @version CVS: $Id: StringReader.php,v 1.8 2007/04/11 19:40:27 zandstra Exp $
 */

/**
 * require
 */
require_once( "gi/parse/Reader.php");

class gi_parse_StringReader extends gi_parse_Reader {
    private $in;
    private $pos;

    function __construct( $in ) {
        $this->in = $in;
        $this->pos = 0;
    }

    function getChar() {
        if ( $this->pos >= strlen( $this->in ) ) {
            return false;
        }
        $char = substr( $this->in, $this->pos, 1 );
        $this->pos++;
        return $char;
    }

    function getPos() {
        return $this->pos;
    }

    function pushBackChar() {
        $this->pos--;
    }

    function string() {
        return $this->in;
    }
}
?>
