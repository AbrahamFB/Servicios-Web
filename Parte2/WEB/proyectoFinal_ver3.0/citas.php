<?php

session_start();
require_once('usuario.php');
require_once('DATABASE.php');
require_once('servicios.php');
require_once('citas.php');



class Cita{

  private $id_cita;	
  private $id_servicio;
  private $id;
  private $fecha_cita;

  
  public function setCitas($id_cita,$id_servicio,$id,$fecha_cita){
  $this->id_cita = $id_cita;
  $this->id_servicio = $id_servicio;
  $this->id = $id;
  $this->fecha_cita = $fecha_cita;
  }
  
  
  public function getId_cita(){
      return $this->id_cita;
  }
  
  public function getId_servicio(){
      return $this->id_servicio;
  }
  
  public function getId(){
      return $this->id;
  }
  public function getFecha_cita(){
    return $this->fecha_cita;
  
  }

?>