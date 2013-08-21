<?php
if ( ! isset( $EG_DISABLE_INCLUDES ) ) {
    require_once( "woo/mapper/VenueMapper.php" );
    require_once( "woo/mapper/SpaceMapper.php" );
    require_once( "woo/mapper/EventMapper.php" );
    require_once( "woo/mapper/Collections.php" );
}

class woo_domain_HelperFactory {
    static function getFinder( $type ) {
        $type = preg_replace( "/^.*_/", "", $type );
        $mapper = "woo_mapper_{$type}Mapper";
        if ( class_exists( $mapper ) ) {
            return new $mapper();
        }
        throw new woo_base_AppException( "Unknown: $mapper" );
    }

    static function getCollection( $type ) {
        $type = preg_replace( "/^.*_/", "", $type );
        $collection = "woo_mapper_{$type}Collection";
        if ( class_exists( $collection ) ) {
            return new $collection();
        }
        throw new woo_base_AppException( "Unknown: $collection" );
    }
}
?>
