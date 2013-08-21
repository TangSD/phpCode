<?php
require_once( 'ShopProduct.php' );

$prod_class = new ReflectionClass( 'CdProduct' );
$method = $prod_class->getMethod( "__construct" );
$params = $method->getParameters();

foreach ( $params as $param ) {
  print argData( $param );
}

function argData( ReflectionParameter $arg ) {
  $details = "";
  $name  = $arg->getName();
  $class = $arg->getClass();

  if ( ! empty( $class )  ) {
    $classname = $class->getName();
    $details .= "\$$name must be a $classname object\n"; 
  }
  if ( $arg->allowsNull() ) {
    $details .= "\$$name can be null\n"; 
  }
  if ( $arg->isPassedByReference() ) {
    $details .= "\$$name is passed by reference\n"; 
  }
  return $details;
}

?>
