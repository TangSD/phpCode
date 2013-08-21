<?php
require_once( "gi/parse/Parser.php" );
require_once( "gi/parse/StringReader.php" );
require_once( "gi/parse/Context.php" );
require_once( "parse/ML_Interpreter.php" );

class StringLiteralHandler implements gi_parse_Handler {
    function handleMatch( gi_parse_Parser $parser, gi_parse_Scanner $scanner ) {
        $value = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult( new LiteralExpression( $value ) );
    }
}

class EqualsHandler implements gi_parse_Handler {
    function handleMatch( gi_parse_Parser $parser, gi_parse_Scanner $scanner ) {
        $comp1 = $scanner->getContext()->popResult();
        $comp2 = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult( new EqualsExpression( $comp1, $comp2 ) );
    }
}

class VariableHandler implements gi_parse_Handler {
    function handleMatch( gi_parse_Parser $parser, gi_parse_Scanner $scanner ) {
        $varname = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult( new VariableExpression( $varname ) );
    }
}

class BooleanOrHandler implements gi_parse_Handler {
    function handleMatch( gi_parse_Parser $parser, gi_parse_Scanner $scanner ) {
        $comp1 = $scanner->getContext()->popResult();
        $comp2 = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult( new BooleanOrExpression( $comp1, $comp2 ) );
    }
}

class BooleanAndHandler implements gi_parse_Handler {
    function handleMatch( gi_parse_Parser $parser, gi_parse_Scanner $scanner ) {
        $comp1 = $scanner->getContext()->popResult();
        $comp2 = $scanner->getContext()->popResult();
        $scanner->getContext()->pushResult( new BooleanAndExpression( $comp1, $comp2 ) );
    }
}

class MarkParse {
    private $expression;
    private $operand;
    private $interpreter;
    private $context;

    function __construct( $statement ) {
        $this->compile( $statement );
    }

    function evaluate( $input ) {
        $icontext = new InterpreterContext();
        $prefab = new VariableExpression('input', $input );
        // add the input variable to Context
        $prefab->interpret( $icontext );
 
        $this->interpreter->interpret( $icontext );
        $result = $icontext->lookup( $this->interpreter );
        return $result;
    } 

    function compile( $statement_str ) {
        // build parse tree
        $context = new gi_parse_Context();
        $scanner = new gi_parse_Scanner( new gi_parse_StringReader($statement_str), $context );
        $statement = $this->expression(); 
        $scanresult = $statement->scan( $scanner );
         
        if ( ! $scanresult || $scanner->tokenType() != gi_parse_Scanner::EOF ) {
            $msg  = "";
            $msg .= " line: {$scanner->line_no()} ";
            $msg .= " char: {$scanner->char_no()}";
            $msg .= " token: {$scanner->token()}\n";
            throw new Exception( $msg );
        }
 
        $this->interpreter = $scanner->getContext()->popResult();
    }

    function expression() {
        if ( ! isset( $this->expression ) ) {
            $this->expression = new gi_parse_SequenceParse();
            $this->expression->add( $this->operand() );
            $bools = new gi_parse_RepetitionParse( );
            $whichbool = new gi_parse_AlternationParse();
            $whichbool->add( $this->orExpr() );
            $whichbool->add( $this->andExpr() );
            $bools->add( $whichbool );
            $this->expression->add( $bools );
        }
        return $this->expression;
    }

    function orExpr() {
        $or = new gi_parse_SequenceParse( );
        $or->add( new gi_parse_WordParse('or') )->discard();
        $or->add( $this->operand() );
        $or->setHandler( new BooleanOrHandler() );
        return $or;
    }

    function andExpr() {
        $and = new gi_parse_SequenceParse();
        $and->add( new gi_parse_WordParse('and') )->discard();
        $and->add( $this->operand() );
        $and->setHandler( new BooleanAndHandler() );
        return $and;
    }

    function operand() {
        if ( ! isset( $this->operand ) ) {
            $this->operand = new gi_parse_SequenceParse( );
            $comp = new gi_parse_AlternationParse( );
            $exp = new gi_parse_SequenceParse( );
            $exp->add( new gi_parse_CharacterParse( '(' ))->discard();
            $exp->add( $this->expression() );
            $exp->add( new gi_parse_CharacterParse( ')' ))->discard();
            $comp->add( $exp ); 
            $comp->add( new gi_parse_StringLiteralParse() )
                ->setHandler( new StringLiteralHandler() ); 
            $comp->add( $this->variable() );
            $this->operand->add( $comp );
            $this->operand->add( new gi_parse_RepetitionParse( ) )->add($this->eqExpr());
        }
        return $this->operand;
    }

    function eqExpr() {
        $equals = new gi_parse_SequenceParse();
        $equals->add( new gi_parse_WordParse('equals') )->discard();
        $equals->add( $this->operand() );
        $equals->setHandler( new EqualsHandler() );
        return $equals;
    }

    function variable() {
        $variable = new gi_parse_SequenceParse();
        $variable->add( new gi_parse_CharacterParse( '$' ))->discard();
        $variable->add( new gi_parse_WordParse());
        $variable->setHandler( new VariableHandler() );
        return $variable;
    }
}
?>
