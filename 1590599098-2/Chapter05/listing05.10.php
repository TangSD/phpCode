<?php
namespace test::smithco;
import PHPUnit::Framework::MockObject::Matcher as phpunit;
require_once( "listing05.07.php" );

class myStatelessInvocation extends phpunit::StatelessInvocation {
    //...
}

$x = new myStatelessInvocation();

?>
