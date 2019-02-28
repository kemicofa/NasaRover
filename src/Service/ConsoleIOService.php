<?php

namespace App\Service;

use App\Controller\RoverController;

class ConsoleIOService {

    public function greeting(){
        echo "Welcome to NASA Rover !\n";
    }

    public function start(RoverController $roverController){


        $upper_right_string = readline("Upper right plateau coordinates\n");
        $upper_right        = explode(" ", $upper_right_string);

        $roverController->plateauCoordinates($upper_right);

        while(true){
            $roverString    = readline("Deploy rover\n");
            $rover          = explode(" ", $roverString);
            $id             = $roverController->create($rover);
            /** coordinates or orientation were not valid */
            if($id === -1) continue;

            /** handle rover actions until they are correct */
            do {
                $action     = readline("Send action to rover\n");
                $res        = $roverController->action($id, str_split($action));
            /** actions were not valid */
            }while(!$res);

            $done           = readline("Done? (y/N)");
            if(strtolower($done) === "y"){
                $this->done($roverController->fetchRovers());
                return;
            }
        }
    }

    public function done(array $rovers){
        foreach($rovers as $rover){
            echo $rover->__toString();
        }
    }
}