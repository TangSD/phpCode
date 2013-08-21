<?php
require_once( 'ShopProduct.php' );

class ReflectionUtil {
  static function getClassSource( ReflectionClass $class ) {
    $path = $class->getFileName();
    $lines = @file( $path );
    $from = $class->getStartLine();
    $to   = $class->getEndLine();
    $len  = $to-$from+1;
    return implode( array_slice( $lines, $from-1, $len ));
  }
}

print ReflectionUtil::getClassSource( 
  new ReflectionClass( 'CdProduct' ) );

?>
