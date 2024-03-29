<?php

class consultas
{
    public $proyecto;
    public $coleccion;
    public $documento;
    public $usuario;
    public $categoria;
    public $contrasenia;
    public $isbn;


    public function __construct($proyecto = "serviciosweb-f4e9a-default-rtdb")
    {
        $this->proyecto = $proyecto;
    }



    function create_document($project, $collection, $document)
    {
        $url = 'https://' . $project . '.firebaseio.com/' . $collection . '.json';

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");  // en sustitución de curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $document);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        curl_close($ch);

        // Se convierte a Object o NULL
        return json_decode($response);
    }


    function read_document($project, $collection, $document)
    {
        $url = 'https://' . $project . '.firebaseio.com/' . $collection . '/' . $document . '.json';

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        curl_close($ch);

        // Se convierte a Object o NULL
        return json_decode($response);
    }

    function update_document($project, $collection, $document, $fields)
    {
        $url = 'https://' . $project . '.firebaseio.com/' . $collection . '/' . $document . '.json';

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (!is_null(json_decode($response))) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");  // en sustitución de curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
            $response = curl_exec($ch);
        }

        curl_close($ch);

        // Se convierte a Object o NULL
        return json_decode($response);
    }


    function delete_document($project, $collection, $document)
    {
        $url = 'https://' . $project . '.firebaseio.com/' . $collection . '/' . $document . '.json';

        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        // Si no se obtuvieron resultados, entonces no existe la colección
        if (is_null(json_decode($response))) {
            $resBool =  false;
        } else {    // Si existe la colección, entnces se procede a eliminar la colección
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_exec($ch);
            $resBool =  true;
        }

        curl_close($ch);

        // Se devuelve true o false
        return $resBool;
    }


    function obtenerUsuario($user)
    {
        return $this->read_document('serviciosweb-f4e9a-default-rtdb', "usuarios", $user);
    }

    function obtenerCategorias($categoria)
    {
        return $this->read_document('serviciosweb-f4e9a-default-rtdb', "productos", $categoria);
    }
    function obtenerIbsn($isbn)
    {
        return $this->read_document('serviciosweb-f4e9a-default-rtdb', "detalles", $isbn);
    }

    function obtenerRespuesta($resp)
    {
        return $this->read_document('serviciosweb-f4e9a-default-rtdb', "respuestas", $resp);
    }

    function datos($codigo, $mensaje, $data, $status){
        return array(
            'code' => $codigo,
            'message' => $mensaje,
            'data' => $data,
            'status' => $status
        );
    }
}
