<?php

namespace App\Controllers;

use App\Models\User;

class HomeController extends Controller{

    public function getHome($request, $response){

        return $this->_view->render($response, 'home.twig');
    }
}