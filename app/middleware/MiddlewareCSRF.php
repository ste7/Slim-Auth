<?php

namespace App\Middleware;

class MiddlewareCSRF extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        $nameKey = $this->container->csrf->getTokenNameKey();
        $valueKey = $this->container->csrf->getTokenValueKey();
        $name = $request->getAttribute($nameKey);
        $value = $request->getAttribute($valueKey);


        $this->container->view->getEnvironment()->addGlobal('csrf', [
            'name' => $name,
            'value' => $value
        ]);

        $response = $next($request, $response);
        return $response;
    }
}