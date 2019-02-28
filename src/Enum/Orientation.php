<?php

namespace App\Enum;

class Orientation {
    //apply reverse negative for left and positive for right
    const North = [0, 1]; 
    const South = [0, -1];
    //apply reverse negative for right and positive for left
    const East = [1, 0]; 
    const West = [-1, 0];

    static function Get(string $orientation): array {
        switch(strtolower($orientation)){
            case 'n': return self::North;
            case 's': return self::South;
            case 'e': return self::East;
            case 'w': return self::West;
            default:
                throw new \Exception("Unrecognized orientation submitted $orientation");
        }
    }

    static function GetName(array $orientation){
        switch($orientation){
            case self::North: return 'N';
            case self::South: return 'S';
            case self::East: return 'E';
            case self::West: return 'W';
            default:
                throw new \Exception("Unrecognized orientation");
        }
    }
}