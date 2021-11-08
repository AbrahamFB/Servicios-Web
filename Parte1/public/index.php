<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/Servicios-Web/Parte1/public');
error_reporting(0);

$val;

$productos = array(
    'libros' => [
        'LIB001' => 'El señor de los anillos',
        'LIB002' => 'Los límites de la Fundación',
        'LIB003' => 'The Rails Way'
    ],
    'comics' => [
        'COM001' => "El umbral de lo siniestro",
        'COM002' => "La mentira por delante",
        'COM003' => "Cruel Summer"
    ],
    'mangas' => [
        'MAN001' => "Boruto",
        'MAN002' => "Ajin",
        'MAN003' => "Love is war"
    ]
);

$detalles = array(
    'LIB001' => [
        'ISBN' => 'LIB001',
        'Autor' => 'J. R. R. Tolkien',
        'Título' => 'El señor de los anillos',
        'Editorial' => 'Minotauro',
        'Fecha' => '1954',
        'Precio' => 723.00,
        'Descuento' => false
    ],
    'LIB002' => [
        'ISBN' => 'LIB002',
        'Autor' => 'Isaac Asimov',
        'Título' => 'Los límites de la Fundación',
        'Editorial' => 'Bruguera (Barcelona, España)',
        'Fecha' => '1982',
        'Precio' => 289.00,
        'Descuento' => true
    ],
    'LIB003' => [
        'ISBN' => 'LIB003',
        'Autor' => 'Obie Fernandez',
        'Título' => 'The Rails Way',
        'Editorial' => 'sitepoint',
        'Fecha' => '2007',
        'Precio' => 163.33,
        'Descuento' => true
    ],

    'COM001' => [
        'ISBN' => 'COM001',
        'Autor' => 'Sigmund Freud',
        'Título' => "El umbral de lo siniestro",
        'Editorial' => 'Createspace Independent Pub',
        'Fecha' => '2021',
        'Precio' => 517.00,
        'Descuento' => false
    ],
    'COM002' => [
        'ISBN' => 'COM002',
        'Autor' => 'Lorenzo Montatore',
        'Título' => "La mentira por delante",
        'Editorial' => 'Astiberri Ediciones',
        'Fecha' => '2021',
        'Precio' => 400,
        'Descuento' => true
    ],
    'COM003' => [
        'ISBN' => 'COM003',
        'Autor' => 'Bert V. Royal',
        'Título' => "Cruel Summer",
        'Editorial' => 'PANINI',
        'Fecha' => '2021',
        'Precio' => 692.55,
        'Descuento' => false
    ],

    'MAN001' => [
        'ISBN' => 'MAN001',
        'Autor' => 'Masashi Kishimoto, Mikio Ikemoto',
        'Título' => "Boruto",
        'Editorial' => 'Shūeisha',
        'Fecha' => '2017',
        'Precio' => 196.79,
        'Descuento' => false
    ],
    'MAN002' => [
        'ISBN' => 'MAN002',
        'Autor' => 'Gamon Sakurai ',
        'Título' => "Ajin",
        'Editorial' => 'Kōdansha',
        'Fecha' => '2012',
        'Precio' => 143.00,
        'Descuento' => true
    ],
    'MAN003' => [
        'ISBN' => 'MAN003',
        'Autor' => 'Aka Akasaka',
        'Título' => "Love is war",
        'Editorial' => 'Tatsuya Ishikawa; Naoto Nakajima; Taku Funakoshi; Toshihiro Maeda',
        'Fecha' => '2021',
        'Precio' => 129.00,
        'Descuento' => true
    ]
);

$respuestas = array(
    200 => 'Categoría encontrada exitosamente.',
    201 => 'ISBN encontrado exitosamente.',
    300 => 'Categoría no encontrada.',
    301 => 'ISBN no encontrado.',
    500 => 'Usuario no reconocido.',
    501 => 'Password no reconocido.',
    999 => 'Error no identificado'
);

$usuarios = array(
    'pruebas1' => 'de88e3e4ab202d87754078cbb2df6063',
    'pruebas2' => '6796ebbb111298d042de1a20a7b9b6eb',
    'pruebas3' => 'f7e999012e3700d47e6cb8700ee9cf19',
);

function valida($error)
{

    global $val;
    global $respuestas;

    if ($error == 1) {
        $val = array(
            'code' => 999,
            'message' => $respuestas[999],
            'data' => '',
            'status' => 'error'
        );
    }
    if ($error == 2) {
        $val = array(
            'code' => 300,
            'message' => $respuestas[300],
            'data' => '',
            'status' => 'Se ha encontrado la categoria'
        );
    }
    if ($error == 3) {
        $val = array(
            'code' => 301,
            'message' => $respuestas[301],
            'data' => '',
            'status' => 'Error con el ISBN'
        );
    }
    if ($error == 4) {
        $val = array(
            'code' => 500,
            'message' => $respuestas[500],
            'data' => '',
            'status' => 'Error al reconocer el usuario'
        );
    }
    if ($error == 5) {
        $val = array(
            'code' => 501,
            'message' => $respuestas[501],
            'data' => '',
            'status' => 'Error al identificar la contraseña'
        );
    }
}


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/Almacen/Ventas/getProd[/{user}[/{contrasena}[/{categoria}]]]', function (Request $request, Response $response, $args) {


    global $productos;
    global $val;
    global $usuarios, $respuestas;

    $categoria = strtolower($args["categoria"]);
    $pass = $args["contrasena"];
    $user = $args["user"];

    $dat = array(
        "code" => 200,
        "message" => $respuestas[200],
        "data" => json_encode($productos[$categoria], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        "status" => "ok"
    );

    try {
        if (in_array($usuarios[$user], $usuarios)) {
            if ($usuarios[$user] == md5($pass)) {
                if (array_key_exists($categoria, $productos)) {
                    $val = $dat;
                } else {
                    valida(2);
                }
            } else
                valida(5);
        } else {
            valida(4);
        }
    } catch (Exception $e) {
        valida(1);
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


    $dat = array(
        "code" => 201,
        "message" => $respuestas[201],
        "data" => json_encode($detalles[$isbn], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
        "status" => "ok",
        'oferta' => json_encode($detalles[$isbn]["Descuento"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    try {
        if (in_array($usuarios[$user], $usuarios)) {
            if ($usuarios[$user] == md5($pass)) {
                if (array_key_exists($isbn, $detalles)) {
                    $val = $dat;
                } else {
                    valida(3);
                }
            } else
                valida(5);
        } else {
            valida(4);
        }
    } catch (Exception $e) {
        valida(1);
    }

    //$response->getBody()->write("Hola, " . $args["user"] . $args["contrasena"] . $args["isbn"]);

    $response->getBody()->write(json_encode($val, JSON_PRETTY_PRINT));

    return $response;
});


$app->run();
