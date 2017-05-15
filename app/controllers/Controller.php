<?php

namespace App\Controllers;

use \Slim\Views\Twig as View;


class Controller
{
    protected $_view;

    public function __construct(View $view){
        $this->_view = $view;


        $this->_view->getEnvironment()->addGlobal('auth', [
            'isloggedin' => AuthController::isLoggedIn(),
            'username' => AuthController::username()
        ]);
    }
}