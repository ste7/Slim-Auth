<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
Use App\Models\User;

class UsersPassword extends AbstractRule{

    public function validate($input){
        $user = User::where('id', $_SESSION['user'])->first();
        $check = password_verify($input, $user->password);

        return $check ? true : false;
    }
}