<?php

/** Including */
include "src/Controller/RoverController.php";
include "src/Service/ConsoleIOService.php";
include "src/Entity/Plateau.php";
include "src/Entity/Rover.php";
include "src/Enum/Orientation.php";
include "src/Validator/ActionValidator.php";
include "src/Enum/Action.php";
include "src/Service/RoverService.php";

/** Using */
use App\Controller\RoverController;
use App\Service\ConsoleIOService;
use App\Entity\Plateau;
use App\Service\RoverService;

/** Starting App */
$controller = new RoverController(new RoverService(new Plateau()));
$service = new ConsoleIOService();
$service->start($controller);


