<?php
require_once('UserStore.php');
require_once('PHPUnit/Extensions/ExceptionTestCase.php');


class UserStoreTest extends PHPUnit_Extensions_ExceptionTestCase {
    private $store;

    public function setUp() {
        $this->store = new UserStore();
    }

    public function testAddUser_ShortPass() {
        $this->setExpectedException('Exception'); 
        $this->store->addUser(  "bob williams", "a@b.com", "ff" );
        $this->fail("Short password exception expected");
    }

    public function  testAddUser_duplicate() {
            try {
                $ret = $this->store->addUser(  "bob williams", "a@b.com", "123456" );
                $ret = $this->store->addUser(  "bob stevens", "a@b.com", "123456" );
                self::fail( "Exception should have been thrown" );
            } catch ( Exception $e ) {
                $const = $this->logicalAnd(
                            //$this->logicalNot( $this->contains("bob stevens")), 
                            $this->isType('object') 
                        );
                self::AssertThat( $this->store->getUser( "a@b.com"), $const );
            }
    }

    public function  testGetUser() {
        $this->store->addUser(  "bob williams", "a@b.com", "12345" );
        $user = $this->store->getUser(  "a@b.com" );
        $this->assertEquals( $user->getMail(), "a@b.com" );
    }

}
?>
