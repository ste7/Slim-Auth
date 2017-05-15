<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;
use Illuminate\Database\Capsule;


class Validation
{
    private static $_errors = [];
    
    public static function validate($request, $fields = []){

        foreach($fields as $key=>$value){
            try{
                $value->assert($request->getParam($key));
            } catch (NestedValidationException $e) {

                self::addError($key, $e->getMessages());
            }
        }
        
        $_SESSION['errors'] = self::$_errors;
        
        return !self::$_errors ? true : false;
    }


    public static function addError($key, $value){
        self::$_errors[$key] = $value;
    }
}