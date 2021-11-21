<?php
class Usuario{

private $id;	
private $nombre;
private $apellido;
private $contrasenia;
private $rol;


public function setTodos($id,$nombre,$apellido,$contrasenia,$rol){
$this->id = $id;
$this->nombre = $nombre;
$this->apellido = $apellido;
$this->contrasenia = $contrasenia;
$this->rol = $rol;
}

public function setLogin($id,$contrasenia){
	
$this->id = $id;
$this->contrasenia = $contrasenia;
}


public function getId(){
	return $this->id;
}

public function getNombre(){
	return $this->nombre;
}

public function getApellido(){
	return $this->apellido;
}


public function getContrasenia(){
	return $this->contrasenia;
}

public function getRol(){
	return $this->rol;
}


}

?>