<?php

class woo_mapper_Field {
    protected $name=null;
    protected $operator=null;
    protected $comps=array();
    protected $incomplete=false;

    function __construct( $name ) {
        $this->name = $name;
    }

    function addTest( $operator, $value ) {
        $this->comps[] = array( 'name' => $this->name, 'operator' => $operator, 'value' => $value );
    }
    function getComps() { return $this->comps; }
    function isIncomplete() { return empty( $this->comps); }
    
}

class woo_mapper_IdentityObject {
    protected $currentfield=null;
    protected $fields = array();
    private $and=null;
    private $enforce=array();

    function __construct( $field=null, array $enforce=null ) {
        if ( ! is_null( $enforce ) ) {
            $this->enforce = $enforce;
        }
        if ( ! is_null( $field ) ) {
            $this->field( $field );
        }
    }

    function getObjectFields() {
        return $this->enforce;
    }

    function field( $fieldname ) {
        if ( ! $this->isVoid() && $this->currentfield->isIncomplete() ) {
            throw new Exception("Incomplete field");
        }
        $this->enforceField( $fieldname );
        if ( isset( $this->fields[$fieldname] ) ) {
            $this->currentfield=$this->fields[$fieldname]; 
        } else {
            $this->currentfield = new woo_Mapper_Field( $fieldname );
            $this->fields[$fieldname]=$this->currentfield;
        }
        return $this;
    }

    function isVoid() {
        return empty( $this->fields );
    }

    function enforceField( $fieldname ) {
        if ( ! in_array( $fieldname, $this->enforce ) && ! empty( $this->enforce ) ) {
            $forcelist = implode( ', ', $this->enforce );
            throw new Exception("{$fieldname} not a legal field ($forcelist)");
        }
    }
/*
    function add( $fieldname ) {
        if ( ! $this->isVoid() && $this->currentfield->isIncomplete() ) {
            throw new Exception("Incomplete field");
        } 
        return $this->field( $fieldname );
    }
*/

    function eq( $value ) {
        return $this->operator( "=", $value );
    }

    function lt( $value ) {
        return $this->operator( "<", $value );
    }

    function gt( $value ) {
        return $this->operator( ">", $value );
    }

    private function operator( $symbol, $value ) {
        if ( $this->isVoid() ) {
            throw new Exception("no object field defined");
        }
        $this->currentfield->addTest( $symbol, $value );
        return $this;
    }

    function getComps() {
        $ret = array();
        foreach ( $this->fields as $key => $field ) {
            $ret = array_merge( $ret, $field->getComps() );
        }
        return $ret;
    }

    function __toString() { 
        $ret = array();
        foreach( $this->getComps() as $compdata ) {
            $ret[] = "{$compdata['name']} {$compdata['operator']} {$compdata['value']}";
        } 
        return implode( " AND ", $ret );
    }
}    

/*
$idobj = new woo_mapper_IdentityObject();
$idobj->field("name")->eq("The Good Show")
      ->field("start")->gt( time() )
                      ->lt( time()+(24*60*60) )
      ->getComps();
print "$idobj\n";
$test=new woo_mapper_IdentityObject( "myfield", array( "myfield", "otherfield", "newfield" ) );
print_r( $test->eq(4)
     ->add( "otherfield" )->eq('my armpit')
     ->add( "newfield")->lt( 5 )->gt(3)
     ->getComps() );
print $test."\n";
*/
