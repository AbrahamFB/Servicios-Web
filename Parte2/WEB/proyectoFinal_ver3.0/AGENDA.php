<?php

session_start();
require_once('usuario.php');
require_once('DATABASE.php');
require_once('servicios.php');


?>


<html>
<head>
	<title>AGENDA</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>

<style>
      .container{margin-top:100px}
      body {
      width: 1340px;
      padding: 100px;
      border: 5px;
      margin: 1.0;
          }
    </style>

<body>
<p>Estas en <strong>AGENDA</strong></p>

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
		<td><?php echo $citas->getNombre_servicio() ?></td>
        <td><?php echo $citas->getId() ?></td>
        <td><?php echo $citas->getFecha_cita() ?></td>
        
				<td><a href="interfaz.php?id=<?php echo $citas->getId_cita()?>&accion=eliminar_servicio">Eliminar</a>   </td>
			</tr>
			<?php }?>
		</body>
	</table>
	<!--- FIN VER AGENDA------->

    </div>
	<p>
	<a href="cerrar_sesion.php">Cerrar sesion</a>
</p>
