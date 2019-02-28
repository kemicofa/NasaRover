<?php

namespace App\Controller;
use App\Entity\Plateau;
use App\Enum\Orientation;
use App\Entity\Rover;
use App\Validator\ActionValidator;
use App\Service\RoverService;

class RoverController {
    
    private $roverService;

    public function __construct(RoverService $roverSerivce){
        $this->roverService = $roverSerivce;
    }

    public function plateauCoordinates(array $data) {

        if(($count = count($data)) !== 2){
            throw new \Exception("Expected plateau coordinates to be length of 2 but got $count\n");
        }

        /** destructure */
        list($x, $y) = $data;

        try {
            $x = intval($x);
            $y = intval($y);
        } catch(\Exception $e){
            throw new \Exception("Plateau coordinates must be integers");
        }

        /** check to see if both values are above 0 */
        if($x <= 0 || $y <= 0){
            throw new \Exception("Plateau coordinates must be positive");
            return false;
        }

        $this->roverService->applyPlateauUpperRightCoordinates($x, $y);     
    }

    public function action(int $id, array $data): bool {
        
        $rover = $this->roverService->getRover($id);
        /** Ensure all actions are valid */
        if(!ActionValidator::AllValid($data)){
            echo "Unrecognized actions\n";
            return false;
        }

        foreach($data as $action){
            /** apply action */
            $this->roverService->applyAction($rover, $action);
        }
        return true;
    }

    /**
     * creates a new rover
     * 
     * @param array $data 
     * @return int id/index of the rover to be used when applying actions
     */
    public function create(array $data): int {
        
        if(($count = count($data)) !== 3){
            echo "Expected rover data to be length of 3 but got $count";
            return -1;
        }

        list($xString, $yString, $orientationString) = $data;

        /** TODO: check handle if orientation is wrong.. throws exception */
        $orientation = Orientation::Get($orientationString);

        try {

            /** attempting to convert */
            $x = intval($xString);
            $y = intval($yString);

            if(!$this->roverService->locationIsValid($x, $y)){
                echo "Location ($x,$y) is not valid\n";
                return -1;
            }
            return $this->roverService->create($x, $y, $orientation);

        }catch(\Execption $e){
            echo "Expected x and y to be integers\n";
            return -1;
        }
    }

    public function fetchRovers(){
        return $this->roverService->getAllRovers();
    }

}
