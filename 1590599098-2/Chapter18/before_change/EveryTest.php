<?php
if (! defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'EveryTest::main');
}

require_once( "PHPUnit/Framework/TestSuite.php" );
require_once( "PHPUnit/TextUI/TestRunner.php" );
require_once( "AppTests.php" );
require_once( "SomeTests.php" );
require_once( "SomeOtherTests.php" );
require_once( "YetMoreTests.php" );

class EveryTest {
    public static function main() {
        PHPUnit_TextUI_TestRunner::run( self::suite() );
    }

    public static function suite() {
        $ts = new PHPUnit_Framework_TestSuite( 'User Classes');
        $ts->addTest( AppTests::suite() );
        $ts->addTest( SomeTests::suite() );
        $ts->addTest( SomeOtherTests::suite() );
        $ts->addTest( YetMoreTests::suite() );
        return $ts;
    }
}

if (PHPUnit_MAIN_METHOD == 'EveryTest::main') {
    EveryTest::main();
}
?>
