<?php

namespace App\Enum;

class Action {
    const L = -1;
    const R = 1;
    const M = 0;

    static function Get(string $action){
        switch(strtolower($action)){
            case 'l': return self::L;
            case 'r': return self::R;
            case 'm': return self::M;
            default:
                throw new \Exception("Unrecognized action $action");
        }
    }
}