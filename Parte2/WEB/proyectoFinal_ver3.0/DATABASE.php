<?php
	class  DB{
		private static $conexion=NULL;
		public static function conectar(){
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			$dsn= 'mysql:dbname=angelblack;host=127.0.0.1'; //DB A MODIFICAR
			//mysql:host=localhost;angelblack=login
			self::$conexion= new PDO($dsn,'Admin','admin',$pdo_options);
			return self::$conexion;
		}		
	} 

//CLASS CRUD
	class CRUD{
		public function insertar($usuario){
		$db=DB::conectar();
		$insert=$db->prepare('INSERT INTO users2 values(:id,:nombre,:apellido,:contrasenia,:rol)');
		$insert->bindValue('id',$usuario->getid());
	    $insert->bindValue('nombre',$usuario->getNombre());
		$insert->bindValue('apellido',$usuario->getApellido());
		$insert->bindValue('contrasenia',$usuario->getContrasenia());
		$insert->bindValue('rol',$usuario->getRol());
		$insert->execute();
		}	

	//ACTUALIZAR ROL
public function actualizar_rol($id,$rol){
	$db=DB::conectar();
	$actualizar=$db->prepare('UPDATE users2   SET rol = :rol WHERE id = :id');
	$actualizar->bindValue('rol', $rol);
	$actualizar->bindValue('id', $id);
	$actualizar->execute();
	}
	//FIN ACTUALIZAR ROL

	//ELIMINAR USUARIOS
public function eliminar($id){
	$db=DB::conectar();
	$eliminar=$db->prepare('DELETE FROM users2 WHERE id = :id');
	$eliminar->bindValue('id',$id);
	$eliminar->execute();
		}
	//FIN ELIMINAR USUARIOS

	//INSERTAR SERVICIO
public function insertar_servicio($servicio){
	$db=DB::conectar();
	$insert=$db->prepare('INSERT INTO servicios values(:id_servicio,:nombre_servicio,:costo_servicio)');
	$insert->bindValue('id_servicio',$servicio->getidServicios());
	$insert->bindValue('nombre_servicio',$servicio->getNombre_servicio());
	$insert->bindValue('costo_servicio',$servicio->getCosto_servicio());
	$insert->execute();
	}
	//FIN INSERTAR SERVICIO


	//MODIFICAR SERVICIOS
	public function modificar_servicio($id_servicio,$nombre_servicio, $costo_servicio){
		$db=DB::conectar();
		$actualizar_servicios=$db->prepare('UPDATE users2   SET servicio = :servicio WHERE id_servicio = :id_servicio');
		$actualizar_servicios->bindValue('id_servicio', $id_servicio);
		$actualizar_servicios->bindValue('nombre_servicio', $nombre_servicio);
		$actualizar_servicios->bindValue('costo_servicio', $costo_servicio);
		$actualizar->execute();
		}
	//FIN MODIFICAR SERVICIOS


	//CARGAR USUARIO
		public function cargarUsuario($id){
			$db=DB::conectar();
			$select=$db->prepare('SELECT * FROM users2 WHERE id = :id');
			$select->bindValue('id',$id);
			$select->execute();
			$usuario=$select->fetchALL();
	$usuario= new Usuario();
	$usuario->setTodos($user['id'],$user['nombre'],$user['apellido'],$user['contrasenia'],$user['rol']);
			return $usuario;

			//CARGAR USUARIO CON ID 
			$crud=new CRUD();
			$id=$_SESSION['id_usuario'];
			$usuario=$crud->cargarUsuario($id);
			$usuario->getId();
			return $usuario;
		}
		//FIN CARGAR USUARIO



	//LOGIN
		public function login($usuario){
			$db=DB::conectar();
			$select=$db->prepare('SELECT count(nombre) as contador  FROM users2 WHERE id=:id and contrasenia =:contrasenia');
			$select->bindValue('id',$usuario->getId());
			$select->bindValue('contrasenia',$usuario->getContrasenia());
			//$usuario->cargarUsuario('rol'->getRol());
			$select->execute();
			$usuario=$select->fetchAll();
			return $usuario['contador'];
		}
	//FIN LOGIN
		public function cargarTodos(){
			$db=DB::conectar();
			$lista=[];
			$select=$db->query('SELECT * FROM users2');
			foreach($select->fetchAll() as $usuariobd){
			$newusuario = new usuario();
			$newusuario->setTodos($usuariobd['id'],$usuariobd['nombre'],$usuariobd['apellido'],$usuariobd['contrasenia'],$usuariobd['rol']);
			$lista[]=$newusuario;

		}
return $lista;
	}

//FUNCION CARGAR SERVICIOS
		public function cargarServicios(){
			$db=DB::conectar();
			$listaServicios=[];
			$select=$db->query('SELECT * FROM servicios');
			foreach($select->fetchAll() as $serviciosbd){
			$newservicio = new servicio();
			$newservicio->setServicios($serviciosbd['id_servicio'],$serviciosbd['nombre_servicio'],$serviciosbd['costo_servicio']);
			$lista[]=$newservicio;
		
		}		
		return $lista;
	}
//FIN FUNCION CARGAR SERVICIOS


//ELIMINAR SRTVICIOS
public function eliminar_servicio($id_servicio){
	$db=DB::conectar();
	$eliminar_servicio=$db->prepare('DELETE FROM servicios WHERE id_servicio = :id_servicio');
	$eliminar_servicio->bindValue('id_servicio',$id_servicio);
	$eliminar_servicio->execute();
		}	
//FIN ELIMINAR SERVICIOS


//INSERTAR CITAS
public function insertar_cita($id_cita, $id_servicio, $id, $fecha_cita){
	$db=DB::conectar();
	$insertar=$db->prepare('INSERT INTO citas values(:id_cita, :nombre_servicio, :id, :fecha_cita)');
	$insertar->bindValue('id_cita', $id_cita);
	$insertar->bindValue('id_servicio', $id_servicio);
	$insertar->bindValue('id', $id);
	$insertar->bindValue('fecha_cita', $fecha_cita);
	$insertar->execute();
	}
//FIN INSERTAR CITAS


	
//FUNCION CARGAR CITAS
public function cargarCitas(){
	$db=DB::conectar();
	$listacitas=[];
	$select=$db->query('SELECT * FROM citas');
	foreach($select->fetchAll() as $citasbd){
	$newCita = new cita();
	$newCita->setCitas($citasbd['id_cita'],$citasbd['id_servicio'],$citasbd['id'],$citasbd['fecha_cita']);
	$listacitas[]=$newCita;

}		
return $listacitas;
}
//FIN FUNCION CARGAR CITAS


}
//FIN CLASS CRUD


?>