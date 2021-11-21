<?php
require_once('usuario.php');
require_once('DATABASE.php');
require_once('servicios.php');


$crud = new CRUD();

if (isset($_POST['insertar'])) {
	echo ('se esta ejecutando interfaz');
		$usuario = new Usuario();
		$usuario->setTodos($_POST['nombre'] . $_POST['apellido'], $_POST['nombre'], $_POST['apellido'], $_POST['contrasenia'],0);
		$crud->insertar($usuario);
		session_start();
		$_SESSION['id'] = $_POST['id'];
		header("Location: principal.php"); 
	}
	
	
	//INGRESAR
	if (isset($_POST['ingresar'])) {
		$usuario =new Usuario();
		
		$usuario->setLogin($_POST['id'],$_POST['contrasenia']);
		$login = $crud->login($usuario);
		echo $login;

		//LOGEA COMO ADMINISTRADOR
		if($usuario->getId()==1){
			echo "Eres administrador.";
			header("Location: ADMINISTRADOR.php");
			}
			
		//LOGEA COMO STTCKOM
			 if($usuario->getId()==2){
			   echo "Eres stckom.";
			   header("Location: STCKOM.php");
			 }

		//LOGEA COMO INVENTARIO
			 if($usuario->getId()==3){
				echo "Eres stckom.";
				header("Location: INVENTARIO.php");
			  }


			else{
			  echo 'Ocurrió un error, <a href="index.php">vuelva a intenarlo</a>.<br/>';
			  echo $usuario->getId();
			  echo $usuario->getContrasenia();
			  }
	}
	//FIN INGRESAR

	//ELIMINAR USUARIOS
	if($_GET['accion']=='eliminar'){

		$crud->eliminar ($_GET['id'] );
		header("Location: ADMINISTRADOR.php"); 
	}
	//FIN ELIMINAR USUARIOS


	//ELIMINAR SERVICIO
	if($_GET['accion']=='eliminar_servicio'){

		$crud->eliminar_servicio ($_GET['id_servicio'] );
		header("Location: ADMINISTRADOR.php"); 
	}
	//FIN ELIMINAR SERVICIO


	//MODIFICAR SERVICIO
		if($_GET['accion']=='modificar_servicio'){

			$crud->modificar_servicio ($_GET['id_servicio'],$_GET['nombre_servicio'],$_GET['costo_servicio'] );
			header("Location: ADMINISTRADOR.php"); 
		}
	//FIN MODIFICAR SERVICIO


//FUNCIÓN ESTA MAL?*****
	if(isset($_POST['accion'])){
		$servicio =new Servicio();
		
		$servicio->setServicios($_POST['id_servicio']);
		$login = $crud->login($servicio);
		echo $login;
		if ($login  = 1){
			session_start();
			$_SESSION['id_servicio'] = $_POST['id_servicio'];
			header("Location: ADMINISTRADOR.php"); 
		}

//FIN DE LA FUNCION
	}


//INSERTAR SERVICIO
	if (isset($_POST['insertar_servicio'])) {
		echo ('se esta ejecutando interfaz');
			$servicio = new Servicio();
			$servicio->setServicios($_POST['nombre_servicio'] . $_POST['costo_servicio'] , $_POST['nombre_servicio'],  $_POST['costo_servicio'] );
			$crud->insertar_servicio($servicio);
			header("Location: ADMINISTRADOR.php");

		}
//FIN INSERTAR SERVICIO


//ACTUALIZAR ROL
if (isset($_POST['actualizar_rol'])) {
	echo ('se esta modificando roles ');
	echo $_POST['id'];
	echo ' ';
	echo $_POST['rol'];
	echo ' ';
	//sleep(25);
		$crud->actualizar_rol($_POST['id'],$_POST['rol']);
		header("Location: ADMINISTRADOR.php");

	}
//FIN ACTUALIZAR ROL

//ELIMINAR SERVICIO
		if (isset($_POST['eliminar_servicio'])) {
			echo ('se esta ejecutando interfaz');
				$servicio = new Servicio();
				$servicio->setTodos($_POST['nombre_servicio'] . $_POST['costo_servicio'] , $_POST['nombre_servicio'],  $_POST['costo_servicio'] );
				$crud->insertar_servicio($servicio);
	
			}	
//FIN ELIMINAR SERVICIO

//GUARDAR SERVICIO
if (isset($_POST['guardarServicio'])) {
		//variables
	$id_servicio = $_POST['id_servicio'];
	$id = $_SESSION['id'];

	$id_cita = $_POST['id_servicio'] . " " .  $_POST['id'];
	$fecha_cita = $_POST['fecha_cita'];
		//fin variables

	echo ('se esta guardando un servicio \n');
	echo $_POST['id_servicio'];
	echo $_SESSION['id'];
	echo $_POST ['fecha_cita'];
	$crud->insertar_cita($id_cita, $id_servicio, $id, $fecha_cita);

	//header("Location: ADMINISTRADO.php");
	
	}
//FIN GUARDAR SERVICIO

?>