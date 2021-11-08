<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/Servicios-Web/Parte1/public');

$app->get('/Almacen/Ventas/getProd[/{user}[/{contrasena}[/{categoria}]]]', function (Request $request, Response $response, $args){
     $reqPost = $request->getParsedBody();
     $val1 = $reqPost["user"];
     $val2 = $reqPost["contrasena"];
     $val3 = $reqPost["categora"];
//echo $user.$pass.$categoria;
     $response->getBody()->write("Valores: " . $val1 . " " . $val2 . " " . $val3);
     return $response;


    global $productos;
    global $usuarios, $respuestas, $resp, $resp2;

    //$categoria = strtolower($categoria);

    // $datos = array(
    //     'code' => 200,
    //     'message' => $respuestas[200],
    //     'data' => json_encode($productos[$categoria], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    //     'status' => "ok"
    // );
    // try {
    //     if (in_array($usuarios[$user], $usuarios)) {
    //         if ($usuarios[$user] == md5($pass)) {
    //             if (array_key_exists($categoria, $productos)) {
    //                 return $datos;
    //             } else {
    //                 return valida(2);
    //             }
    //         } else
    //             return valida(5);
    //     } else {
    //         return valida(4);
    //     }
    // } catch (Exception $e) {
    //     return valida(1);
    // }

});

$app->get('/Almacen/Ventas/getProd[/{user}[/{contrasena}[/{isbn}]]]', function ($request, $response, $args){
 
    global $detalles;
    global $usuarios, $respuestas;
    $datos = array(
        'code' => 201,
        'message' => $respuestas[201],
        'data' => json_encode($detalles[$isbn], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        'status' => "ok",
        'oferta' => json_encode($detalles[$isbn]["Descuento"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    try {
        if (in_array($usuarios[$user], $usuarios)) {
            if ($usuarios[$user] == md5($pass)) {
                if (array_key_exists($isbn, $detalles)) {
                    return $datos;
                } else {
                    return valida(2);
                }
            } else
                return valida(5);
        } else {
            return valida(4);
        }
    } catch (Exception $e) {
        return valida(1);
    }

});



$app->run();
?>