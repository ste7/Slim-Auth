<?php

namespace App\Middleware;

use App\Validation\Validator;

class MiddlewareValidation extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if(isset($_SESSION['errors'])){
            $this->container->view->getEnvironment()->addGlobal('error', $_SESSION['errors']);
        }
        
        unset($_SESSION['errors']);
        
        $response = $next($request, $response);
        
        return $response;
    }
}