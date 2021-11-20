<!DOCTYPE html>
<html lang="es">

<head>
<title>Index</title>
  <meta name="viewport" content="initial-scale=1.0">
  <meta charset="utf-8"> 
  <link rel="stylesheet" href="styles.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://bootswatch.com/5/materia/bootstrap.css%22%3E>
    <link rel="stylesheet" href="https://bootswatch.com/_vendor/font-awesome/css/font-awesome.min.css%22%3E>
    <link rel="stylesheet" href="https://bootswatch.com/_vendor/prismjs/themes/prism-okaidia.css%22%3E>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23019901-1%22%3E>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23019901-1');
    </script>

    <style>
      
      #titulo, #texto{
          color: #FFFFFF;
          text-align: center;
        }
      #operaciones{
          width: 600px;
          text-align: center;
          color: #FFFFFF;
          margin-left: auto;
          margin-right: auto;
          background-color: #333333;
      }
   

    </style>
  

</head>


<body background="imagenes\wallpaper.jpg" style="background-repeat: no-repeat; background-position: center center;">

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/Servicios-Web/Parte2/WEB/index.php"><img src="imagenes\Gala_mew_logoV2.png" height="70" width="100" ></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="set.php">Insertar Usuario</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update.php">Actualizar Usuario</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown" href="get.php" id="navbarDropdown">Ver usuarios</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown" href="set_info.php" id="navbarDropdown">Insertar info.</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown" href="update_info.php" id="navbarDropdown">Actualizar info.</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown" href="get_info.php" id="navbarDropdown">Ver info.</a>
      </li>
    </ul>
      <form class="d-flex">
        <input class="form-control me-sm-2" type="text" placeholder="Buscar">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

<br>

<div id="titulo">
  <H3>BIENVENIDO A</H3>
  <img src="imagenes\recursos_humanosV2.png" height="350" width="350" >
</div>

<div id="texto">
  <h4>Por favor selecciona una de las operaciones del navbar para continuar.</h4>
</div>
<br>
<br>
<br>
<br>

</body>


  <!-- Site footer -->
  <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>Sobre nosotros</h6>
            <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, tempora officiis? Provident perferendis, maxime, reprehenderit voluptas optio nam praesentium odio eveniet repellat nulla, ab quasi!</p>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Categorías</h6>
            <ul class="footer-links">
              <li><a href="http://scanfcode.com/category/front-end-development/">UI Design</a></li>
              <li><a href="http://scanfcode.com/category/back-end-development/">PHP</a></li>
              <li><a href="http://scanfcode.com/category/java-programming-language/">Java</a></li>
            </ul>
          </div>

          <div class="col-xs-6 col-md-3">
            <h6>Links</h6>
            <ul class="footer-links">
              <li><a href="http://scanfcode.com/contact/">Contact Us</a></li>
              <li><a href="http://scanfcode.com/privacy-policy/">Privacy Policy</a></li>
              <li><a href="http://scanfcode.com/sitemap/">Sitemap</a></li>
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by GALA DEVELOPERS GROUP</p>
          </div>

        </div>
      </div>
</footer>


</html>