<?php

abstract class gi_parse_Reader {

    abstract function getChar();
    abstract function getPos();
    abstract function pushBackChar();
}
?>
