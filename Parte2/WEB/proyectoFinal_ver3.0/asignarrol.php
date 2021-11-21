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
    echo 'Bienvenido <strong>'  ." "  .   '</strong>, <a href="cerrar_sesion.php">cerrar sesión</a> <br>';
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

$idusr = $_GET['id'];

?>
<html>

<head>
	<title>Mostrar Roles</title>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <script src="bootstrap-clockpicker.js"></script>
  <link rel = "stylesheet" herf="css/bootstrap-clockpicker.min.css">

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
		 <h1><label class="col-sm-2 control-label">Roles</label></h1> <p>
		</div>


<!---Seleccionar ROL-->
<div class="form-group">
          <label for="rol" class="col-sm-3 control-label">Selecciona Rol</label>
          <div class="col-sm-0">

<select id="rol" name="rol">
<option value="0">default</option>
<option value="1">Admin</option>
<option value="2">Stckom</option>
<option value="3">Inventario</option>
</select>
</div>
</div>
<!--- Fin seleccionar ROL------->
<br></br>

<!--- BOTON------->
<div class="form-group">
          <div class="col-sm-offset-3 col-sm-3">
		    <input type='hidden' name='actualizar_rol' value='actualizar_rol'>
            <input type='hidden' name='id' value=<?php echo $idusr ?> >
			<button type="enviar" class="btn btn-default">Enviar</button>
          </div>
        </div>
<!--- Fin BOTON------->
</form>

</body>
</html>