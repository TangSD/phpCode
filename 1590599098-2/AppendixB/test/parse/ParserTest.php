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
require_once( "gi/parse/StringReader.php" );
require_once "gi/parse/Scanner.php";
require_once "gi/parse/Parser.php";
require_once "gi/parse/Context.php";
require_once "test/testutil/BaseTest.php";

/**
 * Unit tests for @{link gi_parse_Scanner}
 *
 * @version    release: @package_version@
 * @author     Matt Zandstra <matt@getinstnce.com>
 * @copyright  2005 Matt Zandstra
 * @license    ## licencelink ##
 * @package    gi_test_parse
 */
class test_parse_ParserTest extends test_testutil_BaseTest {
    protected function setUp() { 
    }     

    protected function tearDown() { }

    private function getScanner( $str ) {
        $context = new gi_parse_Context();
        return new gi_parse_Scanner( new gi_parse_StringReader( $str ), $context );
    }

    public function testWord() {
        $scanner=$this->getScanner( 'tok tok tok tok' );
        $tok = new gi_parse_WordParse('tok');
        $result = $tok->scan( $scanner );
        $context = $scanner->getContext();
        self::AssertEquals( $context->peekResult(), 'tok' );
        self::AssertEquals( $context->resultCount(), 1 );
        self::AssertEquals( $context->popResult(), 'tok' );
        self::AssertTrue( $result );
    }

    public function testNotParse() {
        $scanner=$this->getScanner( '<tok <tok <tok <trick piggle' );
        $not = new gi_parse_NotParse();
        $not->add($this->angleTrick());
        $result = $not->scan( $scanner );
        $context = $scanner->getContext();
        $txt = $context->popResult();
        self::AssertEquals( $txt, "<tok <tok <tok " );
        self::AssertTrue( $result );
   }

    public function testRepetitionFalseTrigger() {

        $scanner=$this->getScanner(  '<tok <tok <tok <trick' );
        $context = $scanner->getContext();
        $container = new gi_parse_SequenceParse();
        $rep = new gi_parse_RepetitionParse( );
        $rep->add( $this->angleTok() );
        $container->add( $rep );
        $container->add( $this->angleTrick() );
        $container->scan( $scanner );
        $context = $scanner->getContext();
        self::AssertEquals( $context->resultCount(), 4  );
        self::AssertEquals( $context->popResult(), "trick" );
        self::AssertEquals( $context->popResult(), "tok" );
        self::AssertEquals( $context->popResult(), "tok" );
        self::AssertEquals( $context->popResult(), "tok" );
        self::AssertEquals( $context->resultCount(), 0  );
        
    }

    public function testRepetition() {
        $scanner=$this->getScanner(  'tok tok tok tok' );
        $manytest = new gi_parse_RepetitionParse();
        $manytest->add( new gi_parse_WordParse('tok') );
        $manytest->scan( $scanner);
        $context = $scanner->getContext();
        self::AssertEquals( $context->peekResult(), 'tok' );
        self::AssertEquals( $context->resultCount(), 4 );
        $testarray = array();
        while ( $x = $context->popResult() ) {
            array_push( $testarray, $x );
        }
        self::AssertEquals( implode("|", $testarray ), 
                            'tok|tok|tok|tok' );
        self::AssertEquals( $context->resultCount(), 0 );
    }

    public function testRepetitionMin() {

        $scanner1=$this->getScanner( '<tok <tok' );
        $scanner2=$this->getScanner( '<tok' );
        $rep = new gi_parse_RepetitionParse( 2 );
        $rep->add( $this->angleTok() );
        $retval1 = $rep->scan( $scanner1 );
        $retval2 = $rep->scan( $scanner2 );

        $context1 = $scanner1->getContext();
        $context2 = $scanner2->getContext();
        $testarray = array();
        /*
        while ( $x = $context1->popResult() ) {
            array_push( $testarray, $x );
        }
        print implode("|", $testarray );
        print "count is ".$context1->resultCount()."\n";
        */
        self::AssertEquals( $context1->resultCount(), 2  );
        self::AssertTrue( $retval1 );
        self::AssertEquals( $context2->resultCount(), 0  );
        self::AssertTrue( ! $retval2 );
    }

    public function testRepetitionMax() {
        $scanner1 = $this->getScanner( '<tok <tok <tok' );
        $scanner2 = $this->getScanner( '<tok <tok <tok <tok <tok' );
                                          
        $rep = new gi_parse_RepetitionParse( 0, 4 );
        $rep->add( $this->angleTok() );
        $retval1 = $rep->scan( $scanner1 );
        $retval2 = $rep->scan( $scanner2 );

        $context1 = $scanner1->getContext();
        $context2 = $scanner2->getContext();
        self::AssertEquals( $context1->resultCount(), 3  );
        self::AssertTrue( $retval1 );
        self::AssertEquals( $context2->resultCount(), 4  );
        self::AssertTrue( $retval2 );
    }


    private function angleTok() {
        $angletest = new gi_parse_SequenceParse();
        $angletest->add( new gi_parse_CharacterParse('<') )->discard();
        $angletest->add( new gi_parse_WordParse('tok') );
        return $angletest;
    }

    private function angleTrick() {
        $trick = new gi_parse_SequenceParse();
        $trick->add( new gi_parse_CharacterParse('<') )->discard();
        $trick->add( new gi_parse_WordParse('trick') );
        return $trick;
    }
}
?>
