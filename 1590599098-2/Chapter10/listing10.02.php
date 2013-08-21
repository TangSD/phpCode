<?php

abstract class Unit {
    abstract function bombardStrength();
}

class Archer extends Unit {
    function bombardStrength() {
        return 4;
    }
}

class LaserCanonUnit extends Unit {
    function bombardStrength() {
        return 44;
    }
}

class Army {
    private $units = array();
    private $armies = array();

    function addUnit( Unit $unit ) {
        array_push( $this->units, $unit );
    }

    function addArmy( Army $army ) {
        array_push( $this->armies, $army );
    }

    function bombardStrength() {
        $ret = 0;
        foreach( $this->units as $unit ) {
            $ret += $unit->bombardStrength();
        }

        foreach( $this->armies as $army ) {
            $ret += $army->bombardStrength();
        }

        return $ret;
    }
}

$main_army = new Army();
$main_army->addUnit( new Archer() );
$main_army->addUnit( new LaserCanonUnit() );

$sub_army = new Army();
$sub_army->addUnit( new Archer() );
$sub_army->addUnit( new Archer() );
$sub_army->addUnit( new Archer() );
$main_army->addArmy( $sub_army );

print "attacking with strength: {$main_army->bombardStrength()}\n";
