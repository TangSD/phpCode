<?php

abstract class Tile {
    abstract function getWealthFactor();
}

class Plains extends Tile {
    private $wealthfactor = 2;
    function getWealthFactor() {
        return $this->wealthfactor;
    }
}

abstract class TileDecorator extends Tile {
    protected $tile;
    function __construct( Tile $tile ) {
        $this->tile = $tile;    
    }
}

class DiamondDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor()+2;
    }
}

class PollutionDecorator extends TileDecorator {
    function getWealthFactor() {
        return $this->tile->getWealthFactor()-4;
    }
}

$tile = new Plains();
print $tile->getWealthFactor(); // 2
// Plains is a component. It simply returns 2

$tile = new DiamondDecorator( new Plains() );
print $tile->getWealthFactor(); // 4
// DiamondDecorator has a reference to a Plains object. It invokes
// getWealthFactor() before adding its own weighting of 2

$tile = new PollutionDecorator( new DiamondDecorator( new Plains() ));
print $tile->getWealthFactor(); // 0
// PollutionDecorator has a reference to a DiamondDecorator object which
// has its own Tile reference. 
?>
