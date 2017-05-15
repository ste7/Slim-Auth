<?php

namespace App\Middleware;

class MiddlewareGuest extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        if(!isset($_SESSION['user'])){
            return $response->withRedirect('home');
        }
        
        $response = $next($request, $response);

        return $response;
    }
}