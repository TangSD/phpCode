<?php
if ( ! isset( $EG_DISABLE_INCLUDES ) ) {
    require_once( "woo/mapper/VenueMapper.php" );
    require_once( "woo/mapper/SpaceMapper.php" );
    require_once( "woo/mapper/EventMapper.php" );
    require_once( "woo/mapper/Collections.php" );
}
require_once( "woo/mapper/DomainObjectAssembler.php" );

class woo_domain_HelperFactory {
    static function getFinder( $type ) {
        $factory = woo_mapper_PersistenceFactory::getFactory( $type );
        return new woo_mapper_DomainObjectAssembler( $factory );
        /* 
        $type = preg_replace( "/^.*_/", "", $type );
        $mapper = "woo_mapper_{$type}Mapper";
        if ( class_exists( $mapper ) ) {
            return new $mapper();
        }
        throw new woo_base_AppException( "Unknown: $mapper" );
        */
    }

    static function getCollection( $type ) {
        $factory = woo_mapper_PersistenceFactory( $type );
        return $factory->getCollection();
/*
        $type = preg_replace( "/^.*_/", "", $type );
        $collection = "woo_mapper_{$type}Collection";
        if ( class_exists( $collection ) ) {
            return new $collection();
        }
        throw new woo_base_AppException( "Unknown: $collection" );
*/
    }
}
?>
