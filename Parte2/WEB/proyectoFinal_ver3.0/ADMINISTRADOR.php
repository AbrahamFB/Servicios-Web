<?php

require_once('DATABASE.php');
require_once('usuario.php');
require_once('servicios.php');

$crud = new CRUD();
$usr = new Usuario();
$listaservicios = new servicio();

$listaservicios = $crud->cargarServicios();
$listausuarios = $crud->cargarTodos();

 ?>
<html>
<head>
	<title>Mostrar Usuarios</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>

<style>
      body {
      width: 1340px;
      padding: 100px;
      border: 5px;
      margin: 1.0;
          }
</style>

<body>
<p>Eres <strong>ADMINISTRADOR</strong></p>

<!--- Crear servicio------->
 	    <div class="container">
      <form class="form-horizontal" action="interfaz.php" method="post">
        <div class="form-group">
			 <h2>Crear servicio</h2> <p>
		</div>
		<div class="form-group">

  

          <label for="tb_nombre_servicio" class="col-sm-2 control-label">Servicio</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nombre_servicio" id="tb_nombreServicio" placeholder="Nombre del servicio" required>
          </div>
        </div>


		<div class="form-group">
          <label for="tb_costo_servicio" class="col-sm-2 control-label">Costo servicio</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="costo_servicio" id="tb_costo_servicio" placeholder="Costo del servicio" required>
          </div>
        </div>	

  
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
		    <input type='hidden' name='insertar_servicio' value='insertar_servicio'>
			<button type="submit" class="btn btn-default">Enviar</button>
          </div>
        </div>

      </form>
    </div>
<!--- fin crear SERVICIOS------->



<!--- Crear USUARIOS------->
    <div class="container">
      <form class="form-horizontal" action="interfaz.php" method="post">
        <div class="form-group">
			 <h2>Crear usuario</h2> <p>
		</div>
		<div class="form-group">

    


          <label for="tb_nombre" class="col-sm-2 control-label">Nombre</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nombre" id="tb_nombre" placeholder="Nombre" required>
          </div>
        </div>


		<div class="form-group">
          <label for="tb_apellido" class="col-sm-2 control-label">Apellido</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="apellido" id="tb_apellido" placeholder="Apellido" required>
          </div>
        </div>	

        <div class="form-group">
          <label for="tb_password" class="col-sm-2 control-label">Contrasenia</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="contrasenia" id="tb_contrasenia" placeholder="Contrasenia" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
		    <input type='hidden' name='insertar' value='insertar'>
			<button type="submit" class="btn btn-default">Registrar</button>
          </div>
        </div>


      </form>
    </div>
<!--- fin crear USUARIOS------->

<!--- VER USUARIOS------->
<div class="container">
	<table class ="table table-striped">
	 <h2>Ver usuarios</h2>
    <p></p>      

 <thead>
      <tr>


      <th>Id</th>
			<th>Nombre</th>
			<th>Apellido</th>
      <th>Contrasenia</th>
      <th>Rol</th>
			<th>Modificar</th>
			<th>Eliminar</th>
			      </tr>
		    </thead>	
		<body>
			<?php foreach ($listausuarios as $usr) {?>
			<tr>
       <td><?php echo $usr->getId() ?></td>
				<td><?php echo $usr->getNombre() ?></td>
				<td><?php echo $usr->getApellido()?> </td>
        <td><?php echo $usr->getContrasenia() ?></td>
        <td><?php echo $usr->getRol() ?></td>
				<td><a href="asignarrol.php?id=<?php echo $usr->getId()?>&accion=alert">Modificar</a> </td>
				<td><a href="interfaz.php?id=<?php echo $usr->getId()?>&accion=eliminar">Eliminar</a>   </td>
			</tr>
			<?php }?>
		</body>
	</table>
	<!--- FIN VER USUARIOS------->



  <!--- VER SERVICIOS------->
<div class="container">
	<table class ="table table-striped">
	 <h2>Ver servicios</h2>
    <p></p>      

 <thead>
      <tr>


			<th>Nombre del servicio</th>
			<th>Costo del servicio</th>
			<th>Eliminar</th>
			      </tr>
		    </thead>	
		<body>
			<?php foreach ($listaservicios as $servicios) {?>
			<tr>

				<td><?php echo $servicios->getNombre_servicio() ?></td>
        <td><?php echo $servicios->getCosto_servicio() ?></td>
				<td><a href="interfaz.php?id_servicio=<?php echo $servicios->getIdServicios()?>&accion=eliminar_servicio">Eliminar</a>   </td>
			</tr>
			<?php }?>
		</body>
	</table>
	<!--- FIN VER SERVICIOS------->


	</div>



  <div class="container">
	<table class ="table table-striped">

	 <h2>Ver citas</h2>
    <p></p>      

 <thead>
      <tr>

			<th>Id Cita</th>
			<th>Nombre servicio</th>
     		<th>Id</th>
			<th>fecha</th>

	
			<th>Eliminar</th>
			      </tr>
		    </thead>	
		<body>
			<?php foreach ($listacitas as $citas) {?> 
			<tr>

      	<td><?php echo $citas->getId_cita() ?></td>
		<td><?php echo $citas->getId_servicio() ?></td>
        <td><?php echo $citas->getId() ?></td>
        <td><?php echo $citas->getFecha_cita() ?></td>
        
				<td><a href="interfaz.php?id=<?php echo $citas->getId_cita()?>&accion=eliminar_cita">Eliminar</a>   </td>
			</tr>
			<?php }?>
		</body>
	</table>
	<!--- FIN VER AGENDA------->

    </div>



	<p>
	<a href="cerrar_sesion.php">Cerrar sesion</a>
</p>


 




</body>
</html>