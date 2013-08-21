<?php

class UnitException extends Exception {}

abstract class Unit {
    abstract function addUnit( Unit $unit );
    abstract function removeUnit( Unit $unit );
    abstract function bombardStrength();
}

class Archer extends Unit {
    function addUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }

    function removeUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }

    function bombardStrength() {
        return 4;
    }
}

class LaserCanonUnit extends Unit {
    function addUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }

    function removeUnit( Unit $unit ) {
        throw new UnitException( get_class($this)." is a leaf" );
    }

    function bombardStrength() {
        return 44;
    }
}

class Army extends Unit {
    private $units = array();

    function addUnit( Unit $unit ) {
        if ( in_array( $unit, $this->units, true ) ) {
            return;
        }
        $this->units[] = $unit;
    }

    function removeUnit( Unit $unit ) {
        $units = array();
        foreach ( $this->units as $thisunit ) {
            if ( $unit !== $thisunit ) {
                $units[] = $thisunit;
            }
        }
        $this->units = $units;
    }

    function bombardStrength() {
        $ret = 0;
        foreach( $this->units as $unit ) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}

$main_army = new Army();
$main_army->addUnit( new Archer() );
$main_army->addUnit( new LaserCanonUnit() );

$sub_army = new Army();
$sub_army->addUnit( new Archer() );
$sub_army->addUnit( $test = new Archer() );
$sub_army->addUnit( new Archer() );

$sub_army->removeUnit( $test );
$main_army->addUnit( $sub_army );

print "attacking with strength: {$main_army->bombardStrength()}\n";
