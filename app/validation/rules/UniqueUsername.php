<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
Use App\Models\User;

class UniqueUsername extends AbstractRule{

    public function validate($input){
        $user = User::where('username', $input)->first();

        return !$user ? true : false;
    }
}