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
require_once "DB.php"; // replace with mock
require_once('gi/site/mapper/ComponentMapper.php'); // this is coupling
require_once('gi/mapper/MapperHelperFactory.php'); // this is coupling
require_once('gi/datastore/Registry.php');
require_once('gi/site/model/Component.php');
require_once('gi/site/model/ComponentSchema.php');

/**
 * Unit tests for @{link gi_site_parse_SiteParse}
 *
 * @version    release: @package_version@
 * @author     Matt Zandstra <matt@getinstnce.com>
 * @copyright  2005 Matt Zandstra
 * @license    ## licencelink ##
 * @package    gi_test_site_model
 */
class gi_test_site_model_ComponentTest extends gi_test_testutil_BaseTest {
    protected function setUp() { 

        $schema = new gi_site_model_ComponentSchema('news');
        $schema->setField( "headline" );
        $schema->setField( "body" );
        gi_site_model_ComponentSchemaFactory::storeLocally( $schema );
        $schema = new gi_site_model_ComponentSchema('other');
        gi_site_model_ComponentSchemaFactory::storeLocally( $schema );
        `cat res/mysql-drop-tables.sql | mysql -utest test`; 
        `cat res/mysql-schema.sql | mysql -utest test`; 
        gi_datastore_RequestRegistry::
            set( 'DB', DB::connect('mysql://test@localhost/test') );
    } 

    protected function tearDown() { 
        $watcher = gi_model_ObjectWatcher::instance();
        $watcher->reset();
//        `cat res/mysql-drop-tables.sql | mysql -utest test`; 
    }

    function testInstantiateAndFind() {
        $comp = new gi_site_model_Component( 
                    null, 'news', 'bombings continue', time(), 2000 );
        $id = $comp->getId(); 
        $this->assertTrue( $id > 0 );
        $finder = gi_model_DomainObject
                ::getFinder( gi_site_model_Component );
        $other_comp_ref = $finder->find( $id );
        $this->assertTrue( $comp === $other_comp_ref );
        // forget about objects and add to the database
        $watcher = gi_model_ObjectWatcher::instance();
        $watcher->reset();
        $comp = $finder->find( $id );
        $this->assertTrue( $comp->getId() == $id );
    }


    function testInstantiateAndFindAll() {
        $words = array( "one", "two", "three", "four" ); 
        foreach ( $words as $word ) {
            $comp = new gi_site_model_Component( 
                        null, 'news', $word, time(), 2000  );
        }
        // forget about objects and add to the database
        $watcher = gi_model_ObjectWatcher::instance();
        $watcher->reset();
        $finder = gi_model_DomainObject
                ::getFinder( gi_site_model_Component );
        $collection = $finder->findAll();
        $count = 0;
        foreach ( $collection as $component ) {
            self::AssertEquals( 
                $component->getTitle(), $words[$count] );
            $count++;
        }
    }

    function testAddDataFields() {
        $comp = new gi_site_model_Component( 
                    null, 'news', 'bombings continue', time(), 2000  );
        $id = $comp->getId();
        //$datafield = new gi_site_model_DataField( 
        //            null, "body", "all about it", 'text');
        $comp->setField( 'body', 'all about it' );
        $datafield = $comp->getFieldObject('body');
        self::AssertTrue( $datafield->getComponent() === $comp );

        $watcher = gi_model_ObjectWatcher::instance();
        $watcher->reset();
        $finder = gi_model_DomainObject
                ::getFinder( gi_site_model_Component );
        $comp2 = $finder->find( $id );
        self::AssertEquals( $comp->getTitle(), 'bombings continue' );
        self::AssertTrue( isset( $comp2 ) );
        $fields = $comp2->getDataFields();
        self::assertTrue( $fields->size() == 1 );
        $count = 0;
        $field = $fields->next();
        //foreach ( $fields as $field ) {
           self::AssertEquals( 
               $field->getFieldname(), "body" );
           self::AssertEquals( 
               "all about it", $field->getValue() );
           //$count++;
        //}
    }

    function testUpdate() {
        $comp = new gi_site_model_Component( 
                    null, 'news', 'bombings continue', time(), 2000 );
        $finder = gi_model_DomainObject
                ::getFinder( gi_site_model_Component );
        $id = $comp->getId();
        $watcher = gi_model_ObjectWatcher::instance();
        $watcher->reset();
        $comp = $finder->find( $id );
        $comp->setTitle( "bombings stopped now" );
        $watcher->reset();
        $comp = $finder->find( $id );
        self::AssertEquals( $comp->getTitle(), "bombings stopped now" );
    }

    function testExpiry() {
        $time = time();
        $expiry =    array( 3000,  3000,       0,    0 ); 
        $datelines = array( $time, $time-6000, $time, $time-6000); 
        $words =     array( "one", "two",      "three", "four" ); 
        for ( $x=0; $x < count( $words ); $x++  ) {
            $comp = new gi_site_model_Component( 
               null, 'news', $words[$x], $datelines[$x], $expiry[$x] );
        }
         
        $comp = new gi_site_model_Component( 
             null, 'other', 'other', $time, 3000 );

        $watcher = gi_model_ObjectWatcher::instance();
        $watcher->reset();
        $finder = gi_model_DomainObject
                ::getFinder( gi_site_model_Component );
        $collection = $finder->findExpired();
        self::assertTrue( $collection->size() == 1 );
        $comp = $collection->next();
        self::assertEquals( $comp->getTitle(), 'two'  );

        $collection = $finder->findNonExpired();
        self::assertTrue( $collection->size() == 4 );
        $comp = $collection->next();
        self::assertEquals( $comp->getTitle(), 'one' );
        $collection = $finder->findNonExpired( null, 'news' );
        self::assertTrue( $collection->size() == 3 );
    }


} 
