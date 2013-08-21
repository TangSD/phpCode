<?php
abstract class Lesson {
    protected $duration;
    const     FIXED = 1;
    const     TIMED = 2;
    private   $costtype = 1;

    function __construct( $duration, $costtype=1 ) {
        $this->duration = $duration;
        $this->costtype = $costtype;
    }

    function cost() {
        switch ( $this->costtype ) {
            CASE self::TIMED :
                return (5 * $this->duration); 
                break;
            CASE self::FIXED :
                return 30;
                break;
            default:
                $this->costtype = self::FIXED;
                return 30;
        }
    }

    function chargeType() {
        switch ( $this->costtype ) {
            CASE self::TIMED :
                return "hourly rate"; 
                break;
            CASE self::FIXED :
                return "fixed rate"; 
                break;
            default:
                $this->costtype = self::FIXED;
                return "fixed rate"; 
        }
    }

    // more lesson methods...
}

class Lecture extends Lesson {
    // Lecture specific implementations ... 
}

class Seminar extends Lesson {
    // Seminar specific implementations ... 
}

$lesson = new Seminar( 4, Lesson::TIMED );
$lesson = new Seminar( 4, Lesson::FIXED );
$lesson = new Seminar( 4, 33 );
print "lesson charge {$lesson->cost()}. Charge type: {$lesson->chargeType()}\n";
?>
