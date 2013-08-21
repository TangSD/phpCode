<?php
namespace test::smithco;
require_once( "listing05.07.php" );

class myStatelessInvocation extends PHPUnit::Framework::MockObject::Matcher::StatelessInvocation {
    //...
}

$x = new myStatelessInvocation();



?>
