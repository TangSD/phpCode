<?php
require_once("gi/parse/Scanner.php");
require_once("gi/parse/Context.php");
require_once("gi/parse/StringReader.php");

$context = new gi_parse_Context();
$user_in = "\$input equals '4' or \$input equals 'four'";
$reader = new gi_parse_StringReader( $user_in );
$scanner = new gi_parse_Scanner( $reader, $context );

while ( $scanner->nextToken() != gi_parse_Scanner::EOF ) {
    print $scanner->token();
    print "\t{$scanner->char_no()}";
    print "\t{$scanner->getTypeString()}\n";
}
?>
