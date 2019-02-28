<?php

namespace App\Entity;

class Plateau {


    private $bottomX = 0;
    private $bottomY = 0;
    private $upperX;
    private $upperY;

    public function setUpperRightCoordinates(int $x, int $y){
        $this->upperX = $x;
        $this->upperY = $y;
    }

    public function isWithin(int $x, int $y): bool {
        return $x >= $this->bottomX && 
                $x <= $this->upperX && 
                $y >= $this->bottomY && 
                $y <= $this->upperY;
    }

}