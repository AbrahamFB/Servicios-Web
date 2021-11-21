<?php

session_start();
require_once('usuario.php');
require_once('DATABASE.php');
require_once('servicios.php');



class Servicio{

  private $id_servicio;	
  private $nombre_servicio;
  private $costo_servicio;

  
  public function setServicios($id_servicio,$nombre_servicio,$costo_servicio){
  $this->id_servicio = $id_servicio;
  $this->nombre_servicio = $nombre_servicio;
  $this->costo_servicio = $costo_servicio;
  }
  
  
  public function getIdServicios(){
      return $this->id_servicio;
  }
  
  public function getNombre_servicio(){
      return $this->nombre_servicio;
  }
  
  public function getCosto_servicio(){
      return $this->costo_servicio;
  }
  
  
  }

?>