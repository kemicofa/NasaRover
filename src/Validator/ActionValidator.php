<?php

namespace App\Validator;

class ActionValidator {

    const Actions = ['l', 'r', 'm'];

    static function IsValid(string $action): bool {
        return in_array(strtolower($action), self::Actions);
    }

    static function AllValid(array $actions): bool {
        foreach($actions as $action){
            $res = self::IsValid($action);
            if(!$res) return false;
        }
        return true;
    }
}