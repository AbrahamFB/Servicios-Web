<!DOCTYPE html>
<html lang="es">

<head>
<title>updateUserInfo</title>
<meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8"> 
  <link rel="stylesheet" href="styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../5/lux/bootstrap.css">
  <link rel="stylesheet" href="../_vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../_vendor/prismjs/themes/prism-okaidia.css">
  <link rel="stylesheet" href="../_assets/css/custom.min.css">
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23019901-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23019901-1');

        //para crear el JSON
        document.addEventListener("DOMContentLoaded", function(e) {

      var miForm = document.getElementById('miForm');
      miForm.onsubmit = function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var jsonData = {};
        for (var [k, v] of formData) {
          jsonData[k] = v;
        }
        console.log(jsonData);
      }

      });
    </script>

    <style>
      
     

      #subtitulo{
        font-weight: 640;
      }

      #titulo{
          width: 600px;
          text-align: center;
          margin-left: auto;
          margin-right: auto;
          background-color: #000000;
          
      }
      #box{
        width: 600px;
          text-align: center;
          margin-left: auto;
          margin-right: auto;
          background-color: #FFFFFF ;
      }
      .form-group{
          width: 400px;
          margin-left: auto;
          margin-right: auto;
      }
      .mensaje{
        text-align: left;
        background-color:#ffffff;
        width: 400px;
        margin-left: auto;
        margin-right: auto;
      }

    </style>

</head>


<body background="imagenes\wallpaper.jpg" style="background-repeat: no-repeat; background-position: center center;">
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="imagenes\Gala_mew_logoV2.png" height="70" width="100" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Operaciones</a>
    <div class="dropdown-menu" style="">
    <a class="dropdown-item" href="set.php" id="navbarDropdown">Insertar Usuario</a>
    <a class="dropdown-item" href="update.php" id="navbarDropdown">Actualizar Usuario</a>
    <a class="dropdown-item" href="get.php" id="navbarDropdown">Ver usuarios</a>
    <a class="dropdown-item" href="set_info.php" id="navbarDropdown">Insertar información.</a>
    <a class="dropdown-item" href="update_info.php" id="navbarDropdown">Actualizar información.</a>
    <a class="dropdown-item" href="get_info.php" id="navbarDropdown">Ver información</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="index.php">Inicio</a>
    </div>
  </li>  
    </ul>
    </div>
  </div>
</nav>

<br>

<!--updateUserInfo-->
  
  <div id="box">
    <h1 id="titulo">Actualizar información de usuario</h1>
    <div class="form-group">
      <h2 id="subtitulo" for="userInfo" class="form-label mt-4">Nombre</h2>
      <input type="nombreUsuario" class="form-control" id="searchUser" placeholder="Nombre de usuario" aria-describedby="searchUser">
    </div>
    <br>
    <div>
    <button type="button" class="btn btn-dark" id="searchUser">Buscar</button>
    </div>
    
    <br>
    <div class="form-group">
      <form>    
      <div class = "container"> <table class = "table table-striped">
         <h2> Usuario </h2> <p> </p> <thead> <tr> <th> Nombre </th> <th> Correo </th><th> Rol </th> <th> Teléfono </th> </tr> </thead> <body> 
            </body> </table>
    </div>
    <br>
    </div>
<form action="" method="post" class="form_contact" id="miForm">

<div class="user_info">
<div class="form-group">
  <h2 for="user" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Nombre</h2>
  <td><input type="text" name="name" id="name" value="Angel"/></td>
  </div>
  <div class="form-group">
  <h2 for="pass" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Correo</h2>
  <td><input type="text" name="correo" value="angel@gmail.com" /></td>
  </div>
  <div class="form-group">
 
  <div class="form-group">
      <h2 id="subtitulo" for="rol" class="form-label mt-4">Rol</h2>
      <select type="text" name="rol" id="rol" class="form-select" id="exampleSelect1">
        <option>Ventas</option>
        <option>Almacen</option>
        <option>Recursos humanos</option>
      </select>
    </div>

  </div>
  <div class="form-group">
  <h2 for="pass" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Telefono</h2>
  <td><input type="text" name="telefono" value="23762378" /></td>
  </div>
<br>
  <button type="submit" class="btn btn-dark" value="Enviar" id="btnSend">updateUserInfo</button>

</div>

  
  <br>
<h3 for="user" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Mensaje</h3>
    <div class="mensaje">
    
        <output name="code">code: </output>
        <br>
        <output name="message">message: </output>
        <br>
        <output name="status">status: </output>
    </div>
    <br>
  </div>
</div>

</form>
    

    


<br>
<br>
<br>
<br>

</body>
 <!-- Site footer -->
 <footer class="site-footer">
      <div class="container">
        <div class="row">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by GALA DEVELOPERS GROUP</p>
          </div>

        </div>
      </div>
</footer>



</html>