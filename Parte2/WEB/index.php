<!DOCTYPE html>
<html lang="es">

<head>
<title>Index</title>
  <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
      nav {

      padding: 0px;
      border: 0px;
      margin: 0;
      }
      
      body {

      padding: 5px;
      border: 5px;
      margin: 1.0;
      }
    </style>

</head>


<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/Servicios-Web/Parte2/WEB/#"><img src="imagenes\Gala_logo.png" height="70" width="90" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto"></ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Buscar">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>


<h3>OPERACIONES:</h3>

<br>

<!--setUser-->
<form>
  <h4>Insertar usuario.</h4>
    <div class="form-group">
      <label for="user" class="form-label mt-4">Usuario</label>
      <input type="nombreUsuario" class="form-control" id="user" placeholder="Nombre de usuario" aria-describedby="setUser">
    </div>
    <div class="form-group">
      <label for="pass" class="form-label mt-4">Contraseña</label>
      <input type="password" class="form-control" id="pass" placeholder="Contraseña" aria-describedby="setUser">
    </div>
    <div>
      <button type="button" class="btn btn-dark" id="setUser">Insertar</button>
    </div>
</form>

<br>
<br>

<!--updateUser-->
<form>
  <h4>Actualizar usuario.</h4>
    <div class="form-group">
      <label for="newUser" class="form-label mt-4">Nuevo nombre de usuario</label>
      <input type="nuevoUsuario" class="form-control" id="newUser" placeholder="Nombre de usuario" aria-describedby="updateUser">
    </div>
    <div class="form-group">
      <label for="newPass" class="form-label mt-4">Nueva contraseña</label>
      <input type="newPassword" class="form-control" id="newPass" placeholder="Contraseña" aria-describedby="updateUser">
    </div>
    <div>
      <button type="button" class="btn btn-dark" id="updateUser">Actualizar</button>
    </div>
</form>

<br>
<br>

<!--getUser-->
<form>
  <h4>Mostrar usuarios.</h4>

  <div class="form-group">
      <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>
  
    <div>
      <button type="button" class="btn btn-dark" id="getUser">getUser</button>
    </div>
</form>

</body>


</html>