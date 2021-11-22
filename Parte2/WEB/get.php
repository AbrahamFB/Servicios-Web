<!DOCTYPE html>
<html lang="es">

<head>
  <title>getUsers</title>
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
    document.addEventListener("DOMContentLoaded", function(e) {

      var miForm = document.getElementById('miForm');
      miForm.onsubmit = async function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var jsonData = {};
        for (var [k, v] of formData) {
          jsonData[k] = v;
        }

        console.log(jsonData);
        let name = jsonData.usernameA;
        let password = jsonData.passwordA
        let data = {
          name,
          password
        };
        var url = 'https://localhost:44332/api/setUser/login';
        let response = await fetch(url, {
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
            method: 'POST',

          }).then(res => res.json())
          .then(response => response);
        console.log(response);
        data = {
          name: jsonData.username,
          password: jsonData.password
        }
        url = 'https://localhost:44332/api/setUser/get/user/'
        response = await fetch(url, {
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'Authorization': 'Bearer ' + response.token
            },
            method: 'GET',

          }).then(res => res.json())
          .then(response => response);
        console.log(response);
        let use = document.querySelector('#us');
        let output = document.querySelector('#output');
        console.log(`use ${use}`);
        console.log(`output ${output}`);
        let mensaje;
        if (response.status === 'success') {

          usuario = response.data;
          mensaje = response.message;
        } else {
          mensaje = `Error: ${response.message}`;
        }
        let table = document.getElementById("tab");
        let arr = usuario;
        arr.forEach((el, index) => {
          table.innerHTML += "<tr><td>" + el + "</td></tr>";
        });

        output.innerHTML = mensaje;

        console.log(data);
      }
    });
  </script>

  <style>
    #titulo {
      color: #FFFFFF;
      width: 900px;
      height: 40px;
      text-align: center;
      margin-left: auto;
      margin-right: auto;
      background-color: #000000;
    }

    #box {
      margin-top: 0px;
      width: 900px;
      text-align: center;
      margin-left: auto;
      margin-right: auto;
      min-height: 500px;
      display: grid;
      grid-template-columns: repeat(1, 1fr);
      grid-gap: 10px;
      background-color: #FFFFFF;
      margin: auto;
    }

    input {
      width: 200px;
    }

    #usernameA {
      width: 225px;
    }

    #subtitulo {
      font-weight: 640;

    }

    .form-group {
      width: 400px;
      margin-left: auto;
      margin-right: auto;
    }

    .lista {


      width: 550px;
      float: left;
      height: auto;

    }

    .mensaje {
      text-align: left;
      width: 280px;
      float: left;
      background-color: #CCC9C9A9;
      margin-left: 50px;
      margin-right: 20px;
      height: 150px;

    }

    .conteiner {
      height: auto;
    }
  </style>

</head>


<body background="imagenes\wallpaper.jpg" style="background-repeat: no-repeat; background-position: center center;">
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="imagenes\Gala_mew_logoV2.png" height="70" width="100"></a>
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


  <!--getUser-->

  <h2 id="titulo">Ver usuarios</h2>
  <div id="box">
    <div class="box">
      <br>
      <form action="" method="post" class="form_contact" id="miForm" onsubmit="return false">
        <h5>Ingrese sus credenciales: </h5>
        <h6 for="userA" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Usuario
          <td><input type="text" name="usernameA" id="usernameA" value="" /></td>
        </h6>

        <div class="form-group">
          <h6 for="passA" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Contraseña
            <td><input type="text" name="passwordA" value="" /></td>
          </h6>
        </div>
        <br>
        <button onclick="sendForm()" type="submit" class="btn btn-dark" value="Enviar" id="btnSend">Ver usuarios</button>
      </form>
    </div>
    <div class="lista">
      <!--getUserInfo-->

      <br>
      <div class="container">
        <table class="table table-striped" id="tab">
          <h3> Lista de usuarios </h3>
          <p> </p>
          <thead>
            <tr>
              <th> Nombre del usuario </th>
            </tr>
          </thead>

          <body>
            <tr>
              <td id="us"></td>
            </tr>
          </body>
        </table>
      </div>
      <br>
    </div>
    <br>
    <h5 for="user" id="subtitulo" for="exampleTextarea" class="form-label mt-4">Mensaje</h5>
    <div class="mensaje">


      <br>
      <output name="message" id="output"> </output>
      <br>

    </div>
    <br>
  </div>



  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
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