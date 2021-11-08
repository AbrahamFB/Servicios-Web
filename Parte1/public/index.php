<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/Servicios-Web/Parte1/public');


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/Almacen/Ventas/getProd[/{user}/{pass}/{categoria}]', function (Request $request, Response $response, $args){

    return $response;
});
$app->get('/Almacen/Ventas', function (Request $request, Response $response, $args){

    return $response;
});

$app->run();