<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * ## licencestring ##
 * @package    GetInstance
 * @author     Matt Zandstra <matt@bgz-consultants.com>
 * @copyright  2005 BGZ Consultants
 * @license    ## licencelink ##
 * @version    CVS: $Id$
 */

/**
 * requires
 */
require_once "PHPUnit2/Framework/TestCase.php";
require_once "gi/util/PathClick.php";
require_once "gi/test/testutil/BaseTest.php";

/**
 * Unit tests for @{link gi_util_PathClickTest}
 *
 * @version    release: @package_version@
 * @author     Matt Zandstra <matt@getinstnce.com>
 * @copyright  2005 Matt Zandstra
 * @license    ## licencelink ##
 * @package    gi_test_util
 */
class gi_test_util_PathClickTest extends gi_test_testutil_BaseTest {
    protected function setUp() { 
        $this->click = 
            new gi_util_PathClick( array( "all", "books"),
                new gi_util_PathClick( array( "all", "history")
            ) );
    }     

    protected function tearDown() { }

/**
 * click through sample data and confirm expected values
 */
    public function testIterate() {
        foreach ( $this->click as $click ) {
            $str .= implode("/", $click )."||";
        }
    
        $this->say( "testIterate()" );
        $this->say( $str );
        self::AssertEquals(
            'all/all||all/history||books/all||books/history||',
            $str );
    }

/**
 * pull out a specific element and check it
 */
    public function testElementAt() {
        $this->say( "testElementAt()" );
        $row = $this->click->elementAt(1);
        $line = implode("/", $row );
        $this->say( $line );
        self::AssertEquals(
            'all/history',
            $line );
    }

/**
 * test the count() method
 */
    public function testCount() {
        $this->say( "testCount()" );
        $count = $this->click->count();
        $this->say( "count returned $count" );
        self::AssertTrue( $count == 4 );
    }
}

?>
