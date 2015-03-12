<?php
//Declares and Initializes the variables twice, with the $this-> function grabs and pulls the variables in this class into the other classes and methods throughout the application.
class Screen {
    private $screenNumber;
    private $noOfFireExits;
    private $noOfSeats;
    private $projectorType;
    
    public function __construct($s, $f, $se, $pr) {
        $this->screenNumber = $s;
        $this->noOfFireExits = $f;
        $this->noOfSeats = $se;
        $this->projectorType = $pr;
    }
    
    public function getscreenNumber() { return $this->screenNumber; }
    public function getfireExits() { return $this->noOfFireExits; }
    public function getSeats() { return $this->noOfSeats; }
    public function getProjector() { return $this->projectorType; }

    
        
    }


