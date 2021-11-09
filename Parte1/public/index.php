<?php

include("consultas.php");
$consulta = new consultas("");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/Servicios-Web/Parte1/public');
error_reporting(0);

$val;


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/Almacen/Ventas/getProd[/{user}[/{contrasena}[/{categoria}]]]', function (Request $request, Response $response, $args) {

    global $productos;
    global $val;
    global $consulta;
    $coleccion = "productos";
    global $usuarios, $respuestas;

    $categoria = strtolower($args["categoria"]);
    $pass = $args["contrasena"];
    $user = $args["user"];


    $resUsuario = $consulta->obtenerUsuario($user);

    $resCategoria = $consulta->obtenerCategorias($categoria);

    try {
        if ($resUsuario != null) {
            if ($resUsuario == md5($pass)) {
                if (!is_null($resCategoria)) {
                    $resRepuesta = $consulta->obtenerRespuesta(200);
                    $val = $consulta->datos(200, $resRepuesta, json_encode($resCategoria, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "Ok");
                } else {
                    $resRepuesta = $consulta->obtenerRespuesta(300);
                    $val = $consulta->datos(300, $resRepuesta, "", "Falló");
                }
            } else {
                $resRepuesta = $consulta->obtenerRespuesta(501);
                $val = $consulta->datos(501, $resRepuesta, "", "Falló");
            }
        } else {
            $resRepuesta = $consulta->obtenerRespuesta(500);
            $val = $consulta->datos(500, $resRepuesta, "", "Falló");
        }
    } catch (Exception $e) {
        $resRepuesta = $consulta->obtenerRespuesta(999);
        $val = $consulta->datos(999, $resRepuesta, "", "Falló");
    }

    //$response->getBody()->write("Hola, " . $args["user"] . $args["contrasena"] . $args["categoria"]);

    $response->getBody()->write(json_encode($val, JSON_PRETTY_PRINT));

    return $response;
});

$app->get('/Almacen/Ventas/getDetails[/{user}[/{contrasena}[/{isbn}]]]', function (Request $request, Response $response, $args) {

    global $detalles;
    global $val;
    global $usuarios, $respuestas;
    $isbn = $args["isbn"];
    $pass = $args["contrasena"];
    $user = $args["user"];
    global $consulta;
    $coleccion = "detalles";

    $resUsuario = $consulta->obtenerUsuario($user);

    $resCategoria = $consulta->obtenerIbsn($isbn);
    try {
        if ($resUsuario != null) {
            if ($resUsuario == md5($pass)) {
                if (!is_null($resCategoria)) {
                    $resRepuesta = $consulta->obtenerRespuesta(201);
                    $val = $consulta->datos(201, $resRepuesta, json_encode($resCategoria, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "Ok");
                } else {
                    $resRepuesta = $consulta->obtenerRespuesta(301);
                    $val = $consulta->datos(301, $resRepuesta, "", "Falló");
                }
            } else {
                $resRepuesta = $consulta->obtenerRespuesta(501);
                $val = $consulta->datos(501, $resRepuesta, "", "Falló");
            }
        } else {
            $resRepuesta = $consulta->obtenerRespuesta(500);
            $val = $consulta->datos(500, $resRepuesta, "", "Falló");
        }
    } catch (Exception $e) {
        $resRepuesta = $consulta->obtenerRespuesta(999);
        $val = $consulta->datos(999, $resRepuesta, "", "Falló");
    }

    //$response->getBody()->write("Hola, " . $args["user"] . $args["contrasena"] . $args["isbn"]);

    $response->getBody()->write(json_encode($val, JSON_PRETTY_PRINT));

    return $response;
});


$app->post('/updateProd', function (Request $request, Response $response, $args) {
    $reqPost = $request->getParsedBody();
    $data[0]["nombre"] = $reqPost["val1"];
    $data[0]["apellidos"] = $reqPost["valo1"];



    $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT));

    return $response;
});


$app->run();
