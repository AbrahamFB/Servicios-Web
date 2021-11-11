<?php

include("consultas.php");
$consulta = new consultas("");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
//$app->setBasePath('/Servicios-Web/Parte1/public');
//error_reporting(0);

$val;

// WSDL del servicio
$servicio = 'https://ws.abrahamfb.com/servicio/producto.php?wsdl';

$servicio2 = "http://localhost:57720/WSRecursosHumanos.svc?wsdl";


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});


$app->get('/Almacen/Ventas/getProd[/{user}[/{contrasena}[/{categoria}]]]', function (Request $request, Response $response, $args) {
    // $params = $request->getParsedBody();
    global $servicio;
    
    $categoria = strtolower($args["categoria"]);
    $pass = $args["contrasena"];
    $user = $args["user"];

    // Se crea el cliente del servicio
	 $client = new SoapClient( $servicio ); 
   
	 // Se invoca el metodo que vamos a probar
	 $result = $client->getProd($user, $pass, $categoria);

    $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return $response;
});

$app->get('/Almacen/Ventas/getDetails[/{user}[/{contrasena}[/{isbn}]]]', function (Request $request, Response $response, $args) {

    global $servicio;
    
    $pass = $args["contrasena"];
    $user = $args["user"];
    $isbn = $args["isbn"];

    $client = new SoapClient( $servicio ); 
   
    // Se invoca el metodo que vamos a probar
    $result = $client->getDetails($user, $pass, $isbn);

   $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

   return $response;
});


$app->post('/Almacen/setProd', function (Request $request, Response $response, $args) {
    $reqPost = $request->getParsedBody();

    global $servicio2;

    $user = $reqPost["user"];
    $pass = $reqPost["pass"];
    $categoria = $reqPost["categoria"];
    $producto = $reqPost["producto"];

   
	$parametros = array('user' => $user, 'pass' => $pass, 'categoria' => $categoria, 'producto' => $producto);

	// Se crea el cliente del servicio
	$client = new SoapClient( $servicio2, $parametros ); 


    // Se invoca el metodo que vamos a probar
    $result = $client->setProd( $parametros );

    $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return $response;
});

$app->put('/Almacen/updateProd', function (Request $request, Response $response, $args) {
    $reqPost = $request->getHeaders();

    global $servicio2;

    $user = $reqPost["user"];
    $pass = $reqPost["pass"];
    $isbn = $reqPost["isbn"];
    $detalles = $reqPost["detalles"];

	$parametros = array('user' => $user[0], 'pass' => $pass[0], 'isbn' => $isbn[0], 'detalles' => $detalles[0]);

	// Se crea el cliente del servicio
	$client = new SoapClient( $servicio2, $parametros ); 

    // Se invoca el metodo que vamos a probar
    $result = $client->updateProd( $parametros );

    $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return $response;
});
$app->delete('/Almacen/deleteProd/{user}/{pass}/{isbn}', function (Request $request, Response $response, $args) {
    $reqPost = $request->getParsedBody();

    global $servicio2;

    $user = $args["user"];
    $pass = $args["pass"];
    $isbn = $args["isbn"];
   
	$parametros = array('user' => $user, 'pass' => $pass, 'isbn' => $isbn);

	// Se crea el cliente del servicio
	$client = new SoapClient( $servicio2, $parametros ); 

    // Se invoca el metodo que vamos a probar
    $result = $client->deleteProd( $parametros );

    $response->getBody()->write(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return $response;
});


$app->run();
