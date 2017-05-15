<?php
use Respect\Validation\Validator as v;

session_start();

require '../app/libs/config.php';
require '../app/libs/database.php';


$app = new \Slim\App($config_slim);

$container = $app->getContainer();


$container['csrf'] = function ($c){
    return new \Slim\Csrf\Guard;
};
$app->add($container->get('csrf'));



$container['view'] = function ($c){
    $view = new \Slim\Views\Twig('../app/views', [
        'cache' => false,
        'debug' => true,
        'auto_reload' => true
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    
    return $view;
};



/* Validation */
$container['Validation'] = function ($c){
    return new \App\Validation\Validation($c);
};

v::with('App\\Validation\\Rules\\');



/* Middleware */
$container['MiddlewareCSRF'] = function ($c){
    return new \App\Middleware\MiddlewareCSRF($c);
};

$container['MiddlewareAuth'] = function ($c){
    return new \App\Middleware\MiddlewareAuth($c);
};

$container['MiddlewareGuest'] = function ($c){
    return new \App\Middleware\MiddlewareGuest($c);
};

$app->add(new \App\Middleware\MiddlewareValidation($container));


/* Controllers */
$container['App\Controller\HomeController'] = function ($c){
    return new \App\Controllers\HomeController($c['view']);
};

$container['AuthController'] = function ($c){
    return new \App\Controllers\AuthController($c['view']);;
};

$container['ProfileController'] = function ($c){
    return new \App\Controllers\ProfileController($c['view']);
};




require '../app/routes/route.php';