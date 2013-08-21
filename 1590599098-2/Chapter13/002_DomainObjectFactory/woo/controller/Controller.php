<?php
require_once( "woo/base/Registry.php"); // using the real one now
require_once( "woo/domain/ObjectWatcher.php"); // using the real one now
require_once( "woo/controller/ApplicationHelper.php"); // using the real one now
require_once( "woo/controller/Request.php"); // using the real one now

class woo_controller_Controller {
    private $applicationHelper;

    private function __construct() {}

    static function run() {
        $instance = new woo_controller_Controller();
        $instance->init();
        $instance->handleRequest();
    }

    function init() {
        $applicationHelper
            = woo_controller_ApplicationHelper::instance();
        $applicationHelper->init();
    }

    function handleRequest() {
        $request = new woo_controller_Request();
        $app_c = woo_base_ApplicationRegistry::appController();
        while( $cmd = $app_c->getCommand( $request ) ) {
            $cmd->execute( $request );
        }
        woo_domain_ObjectWatcher::instance()->performOperations();
        $this->invokeView( $app_c->getView( $request ) );
    }

    function invokeView( $target ) {
        include( "woo/view/$target.php" );
        exit;
    }
}
woo_controller_Controller::run();
?>
