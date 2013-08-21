<?php

class woo_mapper_DomainObjectAssembler {
    protected static $PDO; 
    
    function __construct( woo_mapper_PersistenceFactory $factory ) {
        $this->factory = $factory;
        if ( ! isset(self::$PDO) ) { 
            $dsn = woo_base_ApplicationRegistry::getDSN( );
            if ( is_null( $dsn ) ) {
                throw new woo_base_AppException( "No DSN" );
            }
            self::$PDO = new PDO( $dsn );
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    function getStatement( $str ) {
        if ( ! isset( $this->statements[$str] ) ) {
            $this->statements[$str] = self::$PDO->prepare( $str );
        }
        return $this->statements[$str]; 
    }

    function findOne( woo_mapper_IdentityObject $idobj ) {
        $collection = $this->find( $idobj );
        return $collection->next();
    }

    function find( woo_mapper_IdentityObject $idobj ) {
        $selfact = $this->factory->getSelectionFactory(  );
        list ( $selection, $values ) = $selfact->newSelection( $idobj );
        print "$selection (".implode( $values ).")\n";
        $stmt = $this->getStatement( $selection ); 
        $stmt->execute( $values );
        $raw = $stmt->fetchAll();
        return $this->factory->getCollection( $raw );
    }

    function insert( woo_domain_DomainObject $obj ) {
        $upfact = $this->factory->getUpdateFactory(  );
        list( $update, $values ) = $upfact->newUpdate( $obj ); 
        print "$update (".implode( $values ).")\n";
        $stmt = $this->getStatement( $update ); 
        $stmt->execute( $values ); 
        if ( $obj->getId() < 0 ) {
            $obj->setId( self::$PDO->lastInsertId()  );
        }
        $obj->markClean();
    }
}
?>
