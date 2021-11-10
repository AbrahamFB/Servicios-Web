<?php

ini_set("error_log", "reportes/php-error-producto.log");
require_once('nusoap/lib/nusoap.php');
include("consultas.php");
$consulta = new consultas("");

$server = new soap_server();

$server->configureWSDL('WebServicesBUAP', 'urn:buap_api');
$server->soap_defencoding = 'UTF-8';
$server->decode_utf8 = false;
$server->encode_utf8 = true;


$server->wsdl->addComplexType(
    'RespuestaGetProd',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'code' => ['name' => 'code', 'type' => 'xsd:string'],
        'message' => ['name' => 'message', 'type' => 'xsd:string'],
        'data' => ['name' => 'data', 'type' => 'xsd:string'],
        'status' => ['name' => 'status', 'type' => 'xsd:string']
    )
);

$server->wsdl->addComplexType(
    'RespuestaGetDetails',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'code' => ['name' => 'code', 'type' => 'xsd:string'],
        'message' => ['name' => 'message', 'type' => 'xsd:string'],
        'data' => ['name' => 'data', 'type' => 'xsd:string'],
        'status' => ['name' => 'status', 'type' => 'xsd:string'],
        'oferta' => ['name' => 'oferta', 'type' => 'xsd:boolean']
    )
);

$server->register(
    'getProd',                               // Nombre de la operaci�n (m�todo)
    array(
        'user' => 'xsd:string',
        'pass' => 'xsd:string',
        'categoria' => 'xsd:string'
    ),     // Lista de par�metros; varios de tipo simple o un tipo complejo
    array('return' => 'tns:RespuestaGetProd'),       // Respuesta; de tipo simple o de tipo complejo
    'urn:producto',                         // Namespace para entradas (input) y salidas (output)
    'urn:producto#getProd',                 // Nombre de la acci�n (soapAction)
    'rpc',                                  // Estilo de comunicaci�n (rpc|document)
    'encoded',                              // Tipo de uso (encoded|literal)
    'Nos da una lista de productos de cada categor�a.'  // Documentaci�n o descripci�n del m�todo
);


$server->register(
    'getDetails',                            // Nombre de la operaci�n (m�todo)
    array(
        'user' => 'xsd:string',
        'pass' => 'xsd:string',
        'isbn' => 'xsd:string'
    ),     // Lista de par�metros; varios de tipo simple o un tipo complejo
    array('return' => 'tns:RespuestaGetDetails'),        // Respuesta; de tipo simple o de tipo complejo
    'urn:producto',                         // Namespace para entradas (input) y salidas (output)
    'urn:producto#getDetails',              // Nombre de la acci�n (soapAction)
    'rpc',                                  // Estilo de comunicaci�n (rpc|document)
    'encoded',                              // Tipo de uso (encoded|literal)
    'Nos da una lista de detalles de cada producto.'  // Documentaci�n o descripci�n del m�todo
);



function getProd($user, $pass, $categoria)
{
    global $productos;
    global $proyecto;
    global $consulta;
    $coleccion = "productos";
    global $usuarios, $respuestas, $resp, $resp2;
    $categoria = strtolower($categoria);

    $resUsuario = $consulta->obtenerUsuario($user);

    $resCategoria = $consulta->obtenerCategorias($categoria);

    try {
        if ($resUsuario != null) {
            if ($resUsuario == md5($pass)) {
                if (!is_null($resCategoria)) {
                    $resRepuesta = $consulta->obtenerRespuesta(200);
                    return $consulta->datos(200, $resRepuesta, json_encode($resCategoria, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "Ok");
                } else {
                    $resRepuesta = $consulta->obtenerRespuesta(300);
                    return $consulta->datos(300, $resRepuesta, "", "Falló");
                }
            } else {
                $resRepuesta = $consulta->obtenerRespuesta(501);
                return $consulta->datos(501, $resRepuesta, "", "Falló");
            }
        } else {
            $resRepuesta = $consulta->obtenerRespuesta(500);
            return $consulta->datos(500, $resRepuesta, "", "Falló");
        }
    } catch (Exception $e) {
        $resRepuesta = $consulta->obtenerRespuesta(999);
        return $consulta->datos(999, $resRepuesta, "", "Falló");
    }
}

function getDetails($user, $pass, $isbn)
{
    global $productos;
    global $proyecto;
    global $consulta;
    $coleccion = "detalles";
    global $usuarios, $respuestas, $resp, $resp2;
    $categoria = strtolower($isbn);

    $resUsuario = $consulta->obtenerUsuario($user);

    $resCategoria = $consulta->obtenerIbsn($isbn);
    try {
        if ($resUsuario != null) {
            if ($resUsuario == md5($pass)) {
                if (!is_null($resCategoria)) {
                    $resRepuesta = $consulta->obtenerRespuesta(201);
                    return $consulta->datos(201, $resRepuesta, json_encode($resCategoria, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "Ok");
                } else {
                    $resRepuesta = $consulta->obtenerRespuesta(301);
                    return $consulta->datos(301, $resRepuesta, "", "Falló");
                }
            } else {
                $resRepuesta = $consulta->obtenerRespuesta(501);
                return $consulta->datos(501, $resRepuesta, "", "Falló");
            }
        } else {
            $resRepuesta = $consulta->obtenerRespuesta(500);
            return $consulta->datos(500, $resRepuesta, "", "Falló");
        }
    } catch (Exception $e) {
        $resRepuesta = $consulta->obtenerRespuesta(999);
        return $consulta->datos(999, $resRepuesta, "", "Falló");
    }
}


// Exposici�n del servicio (WSDL)
//$data = !empty($HTTP_RAW_POST_DATA)?$HTTP_RAW_POST_DATA:'';
//@$server->service($data);
// getProd("pruebas1", "12345678a", "libros");
// getDetails("pruebas1", "12345678a", "LIB001");
// Exposici�n del servicio (WSDL) PHP v7.2 o superior
@$server->service(file_get_contents("php://input"));
