<?php

namespace App\Entity;
use App\Enum\Orientation;

class Rover {

    private $x;
    private $y;
    private $orientation;

    public function __construct(int $x, int $y, array $orientation){
        $this->x = $x;
        $this->y = $y;
        $this->orientation = $orientation;
    }

    public function move(){
        list($x, $y) = $this->orientation;
        $this->x += $x;
        $this->y += $y;
    }

    public function getX(): int {
        return $this->x;
    }

    public function setX(int $x){
        $this->x = $x;
    }

    public function getY(): int {
        return $this->y;
    }

    public function setY(int $y){
        $this->y = $y;
    }

    public function getOrientation(): array {
        return $this->orientation;
    }

    public function setOrientation(array $orientation){
        $this->orientation = $orientation;
    }

    public function __toString(): string {
        $orientation = Orientation::GetName($this->orientation);
        return "{$this->x} {$this->y} $orientation";
    }
}