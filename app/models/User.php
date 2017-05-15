<?php

namespace App\Models;
use Illuminate\Database\Capsule;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    public $timestamps = false;


    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'password'
    ];
}