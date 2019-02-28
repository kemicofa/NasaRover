<?php

namespace App\Service;
use App\Entity\Rover; 
use App\Enum\Action;
use App\Entity\Plateau;

class RoverService {

    private $rovers = [];
    private $plateau;
    public function __construct(Plateau $plateau){
        $this->plateau = $plateau;
    }

    public function applyPlateauUpperRightCoordinates(int $x, int $y){
        $this->plateau->setUpperRightCoordinates($x, $y);
    }

    public function applyAction(Rover $rover, string $action){
        $action = Action::Get($action);
        if($action === Action::M) {
            /** moving rover */
            if(!$this->canMove($rover)){
                throw new \Exception("Rover has attempted to go out of bounds");
            }
            $rover->move();
        }
        else {
            /** rotating rover */
            list($x, $y) = $rover->getOrientation();

            /** rotation is simply a reverse with either a positive factor or negative */
            /** determine which factor to use */
            if($x !== 0) $action *= -1;
            $rover->setOrientation([$y*$action, $x*$action]);
        }
    }

    /** create rover, returns rover id/index */
    public function create(int $x, int $y, array $orientation): int {
        array_push($this->rovers, new Rover($x, $y, $orientation));
        return count($this->rovers) - 1;
    }

    /** get a specific rover, shouldn't crash as it's handled internally */
    public function getRover(int $id){
        return $this->rovers[$id];
    }

    public function getAllRovers(){
        return $this->rovers;
    }

    /** check to see if rover can move in its current direction */
    private function canMove(Rover $rover): bool {
        list($x, $y) = $rover->getOrientation();
        $nx = $x + $rover->getX();
        $ny = $y + $rover->getY();
        return $this->locationIsValid($nx, $ny);
    }

    private function roverCollision(int $x, int $y): bool {
        foreach($this->rovers as $rover){
            /** space is already occupied by another rover so not allowed */
            if($rover->getX() === $x && $rover->getY() === $y){
                return true;
            }
        }
        return false;
    }

    public function locationIsValid(int $x, int $y): bool {
        /** if the coordinates are within the plateau and do not collide with anothe rover... everything is fine */
        return $this->plateau->isWithin($x, $y) && !$this->roverCollision($x, $y);
    }

}