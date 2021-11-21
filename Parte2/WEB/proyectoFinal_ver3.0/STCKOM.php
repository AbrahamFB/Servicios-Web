<?php
session_start();

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
	<title>STCKOM</title>
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
<p>Eres <strong>STCKOM</strong></p>
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


 <!--- VER SERVICIOS------->
 <div class="container">
	<table class ="table table-striped">
	 <h2>Ver servicios</h2>
    <p></p>      

 <thead>
      <tr>



			<th>Nombre del servicio</th>
			<th>Costo del servicio</th>

			<th>Modificar?</th>
			<th>Eliminar</th>
			      </tr>
		    </thead>	
		<body>
			<?php foreach ($listaservicios as $servicios) {?>
			<tr>

				<td><?php echo $servicios->getNombre_servicio() ?></td>
        <td><?php echo $servicios->getCosto_servicio() ?></td>
				<td><a href="interfaz.php?id=<?php echo $servicios->getIdServicios()?>&accion=modificar_servicio">Modificar?</a> </td>
				<td><a href="interfaz.php?id=<?php echo $servicios->getIdServicios()?>&accion=eliminar_servicio">Eliminar</a>   </td>
			</tr>
			<?php }?>
		</body>
	</table>
	<!--- FIN VER SERVICIOS------->

    </div>
	<p>
	<a href="cerrar_sesion.php">Cerrar sesion</a>
</p>
