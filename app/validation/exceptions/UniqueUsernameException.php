<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class UniqueUsernameException extends ValidationException{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'This username already exists',
        ]
    ];
}