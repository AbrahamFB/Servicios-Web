

	<?php
	  session_start();
  if(isset($_SESSION['nombre'])){
	  header("Location: principal.php"); 
	  
  }else{}

?>

<!DOCTYPE html>
<html>

  <head>


    <title>ProyectoFinal</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https:77maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <style>
      .container{margin-top:100px}
      body {
      width: 1340px;
      padding: 100px;
      border: 5px;
      margin: 1.0;
          }
    </style>


    <!-- LOGO -->
    <div align="center"><img src="https://lh3.googleusercontent.com/7pLBK_xonys5ldSKtMih-X9odkna5hzWtyQezVx-Tr5F_ksfSoeqDypzlxh0ePSE32Z32_KQ5s8cRlFf3CyHRQkCK9mUzuEndlanAxjnU3Ce28vAu2L9C--DZy9uECXWrgl-BJj3cHNNyF3HBVvGlXD2RnsmrsVHYJudAwzepWpdpEj5C6D4d1J2xZ_yihC7A6cZ__8zOUAYz0VxwU5zavvBUmjFXk8cKS_NhjCO8n9QhPBGYc9-DKdUVJ6-d-b4PJOOmFY01FQntqmlTKuiCwiCMTHSuTLKpaAqFCrtc9XPspjr9Kf9EuXTg60UNTQdx5DNkgpi0ImkdfbsvayUQdCy-37rmiwbYA5JL9zdAnm7ylJEpArip4nR83wMenTgqZtUHhAvWzS6sPBhy1P2bR18-p0DgImXVkmtezu9cnGgawOjIPjnCAJCfQ_xdMwhe8poVXReGNSSo1v46jtDFDvVRymjPZec6PPPJQZHtyyjzRwQHjeAnnExC_eHE2WpmYJtIKvZzYq8iFrGXOjajz_ZD7P05dLsljKqjnGBrCXsjKCod_ibAhqmtb0_ZeQPO0BRK17iKbEPjuRNEKZGL8driwPyJw4KnsGVC_nbIlVnbQ_xwF7x9sOOe3kCnnKunB5JI6HAkMm_zW8xSIHkq6qUA-1mKFP_DuUZVa081kMl-M_J8WyuIGVyf6ufcw=s625-no?authuser=0"
    width="500"
    height="500">
    </div>
<!-- FIN LOGO -->
  </head>
  <body>

<br></br>
<br></br>
<br></br>
<br></br>
<h3 align = "center">Haga una cita online para servicio</h3>
  <p>Ahora puede hacer una cita para su servicio  haciendo uso de nuestro nuevo servicio de agenda integrado. 
  Simplemente introduzca los datos de su vehículo y seleccione las opciones de su servicio. 
  Después elija la fecha y hora que le convenga entre las disponibles y nosotros le confirmaremos su cita.</p>
  <br></br>
  <p align = "center">Registrese o ingrese en caso de contar con una cuenta para agendar su cita;
  también puede ver nuestros servicios disponibles da click en la siguiente imágen:</p>

   <!-- prueba imagen -->
  <a title="INVENTARIO" href="http://localhost/proyectoFinal_ver3.0/INVENTARIO.php">
  <center>
  <img src="https://lh3.googleusercontent.com/pPnIAcL7hJyceKZ6D8yXAfHpB3pjtM-_iJtIeN2rJx3n2LIuCbJj9TVRVxpoiA_d-9Ru4IlyfVCotI10WOgH_0MhX_iEWGL3noHT2fpXik93NZZDipYik2V9P9aBej0lp-DTpUjhxldlMoFnax5zsv2QMkgP7CEf2NdGoh_nmPFgtjIuKIa-XD_tBFF9kGx4fe2hBo1YXLQRvo8mHBrYQ6UN97X2i9wygswv62Bta8g2QKHx06UBQKr1sdlF-ZER2wShuy5BDXLMXGlDbXe5je82UWCs1lOuSiAZAQxeW8tQ8nYXichtxJ2CPWVev_jpPbeD9ICuYkXH98fGoj5991vH7yDPnP_VjoQRz4dkftVu8VWKlInKFjDrn86TmNAuhx079u38j7Yk8bMAC6z9Fn12udZWrR_wh48j4SCnuufGXhdG-PyhzFw-ZpLiJk3UX28YyAlvwuHVxf_mQ5ik4zMk3GBYscODFa9p4cOxfXDT3a-e1I4-_xQW60m6ECnhunzY1ivcpz8WNgoWqdeg28kGVKHV-mTFIuVfV-p1Ttv_4it7n9dNrCdOnupyg1svP42DTgKhBUtBdRtzAWlbi9z_6YC4OtC-Z5fZlv5YB4RYKdnaqYBlUI5bTGB6942NNppKY6u-VCJ96AJznYb_9GnkzPKTEdpmj5D_hT903lCJ0Ab9GMmBx6mfMbLcAg=s625-no?authuser=0"
    width="400"
    height="400">
    </center>
    </a>
 <!-- fin prueba imagen -->


	    <div class="container">
      <form class="form-horizontal" action="interfaz.php" method="post">
        <div class="form-group">
		 <h4><label class="col-sm-2 control-label">Registrate</label></h4> <p>
		</div>
		<div class="form-group">

    <div class="form-group">
          <label for="tb_id" class="col-sm-2 control-label">Usuario</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id" id="tb_id" placeholder="Usuario" required>
          </div>
        </div>


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
          <label for="tb_password" class="col-sm-2 control-label">Contraseña</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="contrasenia" id="tb_contrasenia" placeholder="Contraseña" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
		    <input type='hidden' name='insertar' value='insertar'>
			<button type="submit" class="btn btn-default">Registrarse</button>
          </div>
        </div>

      </form>
    </div>


    <div class="container">
      <form class="form-horizontal" action="interfaz.php" method="post">
        <div class="form-group">
        <h6><label class="col-sm-0 control-label">¿Ya eres usuario?</label></h6> <p>
		 <h4><label class="col-sm-2 control-label">Ingresar</label></h4> <p>
		</div>

    <div class="form-group">
          <label for="tb_id" class="col-sm-2 control-label">Usuario</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id" id="tb_id" placeholder="Usuario" required>
          </div>
        </div>


        <div class="form-group">
          <label for="tb_password" class="col-sm-2 control-label">Contraseña</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="contrasenia" id="tb_contrasenia" placeholder="Contraseña" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
		   <input type='hidden' name='ingresar' value='ingresar'>
            <button type="submit" class="btn btn-default">Ingresar</button>
          </div>
        </div>
      </form>
    </div>

<footer>
<h3 align = "center">Instrucciones</h3>
<p>Para ingresar como ADMINISTRADOR ingrese usuario rol 1 y su contraseña admin</p>
<p>Para ingresar como STCKOM ingrese usuario rol 2 y su contraseña stckom</p>
<p>Para ingresar como INVENTARIO ingrese usuario rol 3 y su contraseña inventario</p>
<br></br>
</footer>
  </body>
</html>
