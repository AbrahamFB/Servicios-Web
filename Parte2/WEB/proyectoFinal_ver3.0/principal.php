<?php
  session_start();
  require_once('usuario.php');
  require_once('DATABASE.php');
  require_once('servicios.php');

  
  $crud = new CRUD();
  echo $id;
  $id = $_SESSION['id_servicios'];
  $usr = new servicio();
  $servicios = $crud->cargarServicios();
  $usuario = $crud->cargarUsuario($id);

   
if(isset($_SESSION['id'])){
  echo 'Bienvenido <strong>' . $usuario->getNombre()  ." " . $usuario->getApellido()  .      '</strong>, <a href="cerrar_sesion.php">cerrar sesión</a> <br>';
  echo '<br>';
  }

//ROLES
if($usuario->getRol()==2){
  echo "Eres stckom.";
  header("Location: STCKOM.php");
}

if($usuario->getRol()==1){
echo "Eres administrador.";
}
  //FIN ROLES


?>
<html>
<head>
	<title>Mostrar Servicios</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https:77maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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

<div class="container">
      <form class="form-horizontal" action="interfaz.php" method="post">
        <div class="form-group">
		 <h1><label class="col-sm-2 control-label">Servicios</label></h1> <p>
		</div>


                                    <!---información exra--->
<!---Seleccionar marca--->
<div class="form-group">
          <label for="marca" class="col-sm-3 control-label">Selecciona marca del auto</label>
          <div class="col-sm-0">

<select id="cbx_marca" name="cbx_marca">
<option value="0">Selecciona marca del auto</option>
<option value="1">Chevrolet</option>
<option value="2">Nissan</option>
<option value="3">Toyota</option>
<option value="4">Volkswagen</option>
<option value="5">Pontiac</option>
<option value="6">Mercedez benz</option>
<option value="7">FIA</option>
<option value="7">Otro</option>
</select>
</div>
</div>
<!--- Fin seleccionar Marcca------->
                                    <!---Fin información exra--->


<br></br>

<!--- SELECCIONAR SERVICIOS------->
<div class="form-group">
          <label for="marca" class="col-sm-3 control-label">Selecciona servicio</label>
          <div class="col-sm-0">


<select   name= "id_servicio" id="id_servicio">
<?php foreach ($servicios as $usr) {?>
<option value =<?php echo $usr->getIdServicios()?>><?php echo $usr->getNombre_servicio() ?></option>
<?php }?>
</select>
</div>
<!--- FIN SELECCIONAR SERVICIOS------->

<br></br>

<!--- SELECCIONAR CITA------->
          <label for="agenda" class="col-sm-3 control-label">Selecciona fecha para agendar</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" name="fecha_cita" id="fecha_cita" placeholder="DD/MM/AAAA" required>
          </div>
        </div>
<!--- FIN SELECCIONAR CITA------->

<br></br>

<div class="form-group">
          <div class="col-sm-offset-3 col-sm-3">
		    <input type='hidden' name='guardarServicio' value='guardarServicio'>
			<button type="enviar" class="btn btn-default">Enviar</button>
          </div>
        </div>

</form>

</body>
</html>