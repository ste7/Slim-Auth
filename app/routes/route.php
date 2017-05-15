<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;



$app->get('/home', function (Request $request, Response $response) {
    $controller = $this->get('App\Controller\HomeController');
    return $controller->getHome($request, $response);
});



/*
 * Auth
 */
$app->get('/signup', function (Request $request, Response $response, $arg) {
    $controller = $this->AuthController;
    return $controller->getSignUp($request, $response);
})->add('MiddlewareCSRF')
    ->add('MiddlewareAuth');

$app->post('/signup',function ($request, $response, $args) {
    $controller = $this->AuthController;
    return $controller->postSignUp($request, $response);
})->add('MiddlewareCSRF');


$app->get('/signin', function (Request $request, Response $response) {
    $controller = $this->AuthController;
    return $controller->getSignIn($request, $response);
})->add('MiddlewareCSRF')
    ->add('MiddlewareAuth');

$app->post('/signin', function (Request $request, Response $response) {
    $controller = $this->AuthController;
    return $controller->postSignIn($request, $response);
})->add('MiddlewareCSRF');

$app->get('/signout', function (Request $request, Response $response) {
    $controller = $this->AuthController;
    return $controller->signOut($request, $response);
})->add('MiddlewareCSRF');



/*
 * Profile
 */
$app->get('/profile', function (Request $request, Response $response) {
    $controller = $this->ProfileController;
    return $controller->getProfile($request, $response);
})->add('MiddlewareCSRF')
    ->add('MiddlewareGuest');

$app->post('/profile', function (Request $request, Response $response) {
    $controller = $this->ProfileController;
    return $controller->postProfile($request, $response);
})->add('MiddlewareCSRF')
    ->add('MiddlewareGuest');