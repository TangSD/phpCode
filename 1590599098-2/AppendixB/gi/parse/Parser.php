<?php

require_once('gi/parse/Scanner.php');

interface gi_parse_Handler {
    function handleMatch(   gi_parse_Parser $parser, 
                            gi_parse_Scanner $scanner );
}

abstract class gi_parse_Parser {

    const GIP_RESPECTSPACE = 1;
    protected $respectSpace = false;
    protected static $debug = false;
    protected   $discard = false;
    protected $name;
    private static $count=0;

    function __construct( $name=null, $options=null ) {
        if ( is_null( $name ) ) {
            self::$count++;
            $this->name = get_class( $this )." (".self::$count.")";
        } else {
            $this->name = $name;
        }
        if ( is_array( $options ) ) {
            if ( isset( $options[self::GIP_RESPECTSPACE] ) ) {
                $this->respectSpace=true;
            }
        }
    }
    
    protected function next( gi_parse_Scanner $scanner ) {
        $scanner->nextToken();
        if ( ! $this->respectSpace ) {
            $scanner->eatWhiteSpace();
        }
    }

    function spaceSignificant( $bool ) {
        $this->respectSpace = $bool;
    }

    static function setDebug( $bool ) {
        self::$debug = $bool;
    }

    function setHandler( gi_parse_Handler $handler ) {
        $this->handler = $handler;
    }

    final function scan( gi_parse_Scanner $scanner ) {
        if ( $scanner->tokenType() == gi_parse_Scanner::SOF ) {
            $scanner->nextToken();
        }
        $ret = $this->doScan( $scanner );
        if ( $ret && ! $this->discard && $this->term() ) {
            $this->push( $scanner );
        }
        if ( $ret ) { 
            $this->invokeHandler( $scanner );
        }

        if ( $this->term() && $ret ) {
            $this->next( $scanner );
        }
        $this->report("::scan returning $ret");
        return $ret;
    }

    function discard() {
        $this->discard = true;
    }

    abstract function trigger( gi_parse_Scanner $scanner );

    function term() {
        return true;
    }

// private/protected

    protected function invokeHandler( 
            gi_parse_Scanner $scanner ) {
        if ( ! empty( $this->handler ) ) {
            $this->report( "calling handler: ".get_class( $this->handler ) );
            $this->handler->handleMatch( $this, $scanner );
        }
    }

    protected function report( $msg ) {
        if ( self::$debug ) {
            print "<{$this->name}> ".get_class( $this ).": $msg\n"; 
        }
    }

    protected function push( gi_parse_Scanner $scanner ) {
        $context = $scanner->getContext();
        $context->pushResult( $scanner->token() );
    }

    abstract protected function doScan( gi_parse_Scanner $scan );
}

abstract class gi_parse_CollectionParse extends gi_parse_Parser {
    protected $parsers = array();

    function add( gi_parse_Parser $p ) {
        if ( is_null( $p ) ) {
            throw new Exception( "argument is null" );
        }
        $this->parsers[]= $p;
        return $p;
    }

    function term() {
        return false;
    }
}

class gi_parse_RepetitionParse extends gi_parse_CollectionParse {
    private $min;
    private $max;

    function __construct( $min=0, $max=0, $name=null, $options=null ) {
        parent::__construct( $name, $options );
        if ( $max < $min && $max > 0 ) {
            throw new Exception(
                "maximum ( $max ) larger than minimum ( $min )");
        }
        $this->min = $min;
        $this->max = $max;
    }

    function trigger( gi_parse_Scanner $scanner ) {
        return true;
    }

    protected function doScan( gi_parse_Scanner $scanner ) {
        $start_state = $scanner->getState();
        if ( empty( $this->parsers ) ) {
            return true;
        }
        $parser = $this->parsers[0];
        $count = 0;

        while ( true ) {
            if ( $this->max > 0 && $count >= $this->max ) {
                return true;
            }

            if ( ! $parser->trigger( $scanner ) ) {
                if ( $this->min == 0 || $count >= $this->min ) {
                    return true;
                } else {
                    $scanner->setState( $start_state );
                    return false;
                }
            }
            if ( ! $parser->scan( $scanner ) ) {
                if ( $this->min == 0 || $count >= $this->min ) {
                    return true;
                } else {
                    $scanner->setState( $start_state );
                    return false;
                }
            }
            $count++;
        }
    return true;
    }
}

class gi_parse_NotParse extends gi_parse_CollectionParse {

    function trigger( gi_parse_Scanner $scanner ) {
        return true;
    }

    protected function push( gi_parse_Scanner $scanner ) {
        return;
    }

    protected function doScan( gi_parse_Scanner $scanner ) {
        $string = "";
        if ( empty( $this->parsers ) ) {
            return true;
        }
        $parser = $this->parsers[0];
        $start_state = $scanner->getState();
        while ( ! $parser->trigger( $scanner ) ||
             ! $parser->scan( $scanner ) ) {
            $string .= $scanner->token();
            $scanner->nextToken( );
            if ( $scanner->tokenType() == gi_parse_Scanner::EOF ) {
                break;
            }
        }
        if ( $string && ! $this->discard ) { 
            $scanner->getContext()->pushResult( $string );
        }
        return ( ! empty( $string ) );
    }
}

class gi_parse_AlternationParse extends gi_parse_CollectionParse {

    function trigger( gi_parse_Scanner $scanner ) {
        foreach ( $this->parsers as $parser ) {
            if ( $parser->trigger( $scanner ) ) {
                return true;
            }
        }
        return false;
    }

    protected function doScan( gi_parse_Scanner $scanner ) {
        $type = $scanner->tokenType();
        foreach ( $this->parsers as $parser ) {
            $start_state = $scanner->getState();
            if ( $type == $parser->trigger( $scanner ) && 
                 $parser->scan( $scanner ) ) {
                 return true;
            }
        }
        $scanner->setState( $start_state );
        return false;
    }
}

class gi_parse_SequenceParse extends gi_parse_CollectionParse {

    function trigger( gi_parse_Scanner $scanner ) {
        if ( empty( $this->parsers ) ) {
            return false;
        }
        return $this->parsers[0]->trigger( $scanner ); 
    }
 
    protected function doScan( gi_parse_Scanner $scanner ) {
        $start_state = $scanner->getState();
        foreach( $this->parsers as $parser ) {
            if ( ! ( $parser->trigger( $scanner ) && 
                    $scan=$parser->scan( $scanner )) ) {
                $scanner->setState( $start_state );
                return false;
            }
        }
        return true;
    }
}

class gi_parse_CharacterParse extends gi_parse_Parser {
    private $char;

    function __construct( $char, $name=null, $options=null ) {
        parent::__construct( $name, $options );
        $this->char = $char;
    }

    function trigger( gi_parse_Scanner $scanner ) {
        return ( $scanner->token() == $this->char );
    }

    protected function doScan( gi_parse_Scanner $scanner ) {
        return ( $this->trigger( $scanner ) );
    } 
}

class gi_parse_StringLiteralParse extends gi_parse_Parser {

    function trigger( gi_parse_Scanner $scanner ) {
        return ( $scanner->tokenType() == gi_parse_Scanner::APOS || 
                 $scanner->tokenType() == gi_parse_Scanner::QUOTE );
    }

    protected function push( gi_parse_Scanner $scanner ) {
        return;
    }

    protected function doScan( gi_parse_Scanner $scanner ) {
        $quotechar = $scanner->tokenType();
        $ret = false;
        $string = "";
        while ( $token = $scanner->nextToken() ) {
            if ( $token == $quotechar ) {
                $ret = true;
                break;
            }
            $string .= $scanner->token();
        } 

        if ( $string && ! $this->discard ) { 
            $scanner->getContext()->pushResult( $string );
        }

        return $ret;
    } 
}

class gi_parse_WordParse extends gi_parse_Parser {
    function __construct( $word=null, $name=null, $options=null ) {
        parent::__construct( $name, $options );
        $this->word = $word;
    }

    function trigger( gi_parse_Scanner $scanner ) {
        if ( $scanner->tokenType() != gi_parse_Scanner::WORD ) {
            return false;
        }
        if ( is_null( $this->word ) ) {
            return true;
        }
        return ( $this->word == $scanner->token() );
    }

    protected function doScan( gi_parse_Scanner $scanner ) {
        $ret = ( $this->trigger( $scanner ) );
        return $ret;
    } 
}
?>
