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
require_once "gi/test/testutil/BaseTest.php";
require_once "gi/site/parse/SiteParse.php";

/**
 * Unit tests for @{link gi_site_parse_SiteParse}
 *
 * @version    release: @package_version@
 * @author     Matt Zandstra <matt@getinstnce.com>
 * @copyright  2005 Matt Zandstra
 * @license    ## licencelink ##
 * @package    gi_test_site_parse
 */
class gi_test_site_parse_SiteParseTest extends gi_test_testutil_BaseTest {
    protected function setUp() { 
        $this->res = dirname(__FILE__).DIRECTORY_SEPARATOR."res";
        $this->sample1 = $this->res.DIRECTORY_SEPARATOR."sample1.txt";
    } 
    protected function tearDown() { }

    function testCompile() {
        $parser = new gi_site_SiteParse();
        $parser->compile();
        $parser->parse( file_get_contents( $this->sample1 ) );
    }
} 
