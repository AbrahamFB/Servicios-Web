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
	<title>INVENTARIO DE SERVICIOS</title>
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
<p>Estas en <strong>INVENTARIO</strong></p>
 <!--- VER SERVICIOS------->
 <div class="container">
	<table class ="table table-striped">
	 <h2>Inventario</h2>
    <p></p>      

 <thead>
      <tr>
			<th>Nombre del servicio</th>
			<th>Costo del servicio</th>

			      </tr>
		    </thead>	
		<body>
			<?php foreach ($listaservicios as $servicios) {?>
			<tr>

				<td><?php echo $servicios->getNombre_servicio() ?></td>
        <td><?php echo $servicios->getCosto_servicio() ?></td>
		
			</tr>
			<?php }?>
		</body>
	</table>
	<!--- FIN VER SERVICIOS------->

    </div>
	<p>
	<a href="cerrar_sesion.php">Cerrar sesion</a>
</p>
