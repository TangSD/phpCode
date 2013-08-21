<?php
require_once( "listing12.05.php" ); // Registry

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
        $cmd_r = new woo_command_CommandResolver();
        $cmd = $cmd_r->getCommand( $request );
        $cmd->execute( $request );
    }
}

class woo_controller_ApplicationHelper {
    private static $instance;
    private $config = "/tmp/data/woo_options.xml";

    private function __construct() {}

    static function instance() {
        if ( ! self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function init() {
        $dsn = woo_base_ApplicationRegistry::getDSN( );
        if ( ! is_null( $dsn ) ) {
            return;
        }
        $this->getOptions();
     }

     private function getOptions() {
        $this->ensure( file_exists( $this->config  ),
                            "Could not find options file" );
        $options = @SimpleXml_load_file( $this->config );
        $this->ensure( $options instanceof SimpleXMLElement,
                            "Could not resolve options file" );
        $dsn = (string)$options->dsn;
        $this->ensure( $dsn, "No DSN found" );
        woo_base_ApplicationRegistry::setDSN( $dsn );
        // set other values
    }

    private function ensure( $expr, $message ) {
        if ( ! $expr ) {
            throw new woo_base_AppException( $message );
        }
    }
}

abstract class woo_command_Command {
    final function __construct() { }

    function execute( woo_controller_Request $request ) {
        $this->doExecute( $request );
    }

    abstract function doExecute( woo_controller_Request $request );
}

class woo_command_DefaultCommand extends woo_command_Command {
    function doExecute( woo_controller_Request $request ) {
        $request->addFeedback( "Welcome to WOO" );
        include( "woo/view/main.php");
    }
}

//require_once( "woo/command/DefaultCommand.php");
class woo_command_CommandResolver {
    private static $base_cmd;
    private static $default_cmd;

    function __construct() {
        if ( ! self::$base_cmd ) {
            self::$base_cmd = new ReflectionClass( "woo_command_Command" );
            self::$default_cmd = new woo_command_DefaultCommand();
        }
    }

    function getCommand( woo_controller_Request $request ) {
        $cmd = $request->getProperty( 'cmd' );
        $sep = DIRECTORY_SEPARATOR;
        if ( ! $cmd ) {
            return self::$default_cmd;
        }
        $cmd=str_replace( array('.', $sep), "", $cmd );
        $filepath = "woo{$sep}command{$sep}{$cmd}.php";
        $classname = "woo_command_$cmd";
        if ( file_exists( $filepath ) ) {
            @require_once( "$filepath" );
            if ( class_exists( $classname) ) {
                $cmd_class = new ReflectionClass($classname);
                if ( $cmd_class->isSubClassOf( self::$base_cmd ) ) {
                    return $cmd_class->newInstance();
                } else {
                    $request->addFeedback( "command '$cmd' is not a Command" );
                }
            }
        }
        $request->addFeedback( "command '$cmd' not found" );
        return clone self::$default_cmd;
    }
}
/*
class woo_base_AppException extends Exception {
}

*/

class woo_controller_Request {
    private $properties;
    private $feedback = array();

    function __construct() {
        $this->init();
        woo_base_RequestRegistry::setRequest($this );
    }

    function init() {
        if ( isset( $_SERVER['REQUEST_METHOD'] ) ) {
            $this->properties = $_REQUEST;
            return;
        }
        foreach( $_SERVER['argv'] as $arg ) {
            if ( strpos( $arg, '=' ) ) {
                list( $key, $val )=explode( "=", $arg );
                $this->setProperty( $key, $val );
            }
        }
    }

    function getProperty( $key ) {
        if ( isset( $this->properties[$key] ) ) {
            return $this->properties[$key];
        }
    }

    function setProperty( $key, $val ) {
        $this->properties[$key] = $val;
    }
    
    function addFeedback( $msg ) {
        array_push( $this->feedback, $msg );
    }
 
    function getFeedback( ) {
        return $this->feedback;
    }

    function getFeedbackString( $separator="\n" ) {
        return implode( $separator, $this->feedback );
    }
}

woo_controller_Controller::run();

?>
