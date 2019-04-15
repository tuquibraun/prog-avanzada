<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <link rel="stylesheet" href="Vista/css/estilo.css">

    <title>Programación Web Avanzada</title>
  </head>
  <body>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">PWA</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="inicio">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bootstrap">Bootstrap</a>
              </li>

              <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Ajax</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="ajax1">Ejercicio 1</a>
                  <a class="dropdown-item" href="ajax2">Ejercicio 2</a>
                  <a class="dropdown-item" href="ajax3">Ejercicio 3</a>
                  <a class="dropdown-item" href="ajax4">Ejercicio 4</a>
                  <a class="dropdown-item" href="ajax5">Ejercicio 5</a>
                  <a class="dropdown-item" href="ajax6">Ejercicio 6</a>
                  <a class="dropdown-item" href="ajax7">Ejercicio 7</a>
                </div>

              </li>
            </ul>
          </div>
        </nav>

<div class="container-fluid pt-5 pb-5">

  <?php

  if(isset($_GET["ruta"])) {

    switch ($_GET["ruta"]) {

      case "":
        include_once 'Vista/modulos/inicio.php';
        break;

      case "inicio":
        include_once 'Vista/modulos/inicio.php';
        break;

      case "bootstrap":
        include_once 'Vista/modulos/practicoBootsrap.php';
        break;

      /* AJAX */
      case "ajax1":
        include_once 'Vista/modulos/ajax/ej1.php';
        break;

        case "ajax2":
        include_once 'Vista/modulos/practicoBootsrap.php';
        break;

        case "ajax3":
        include_once 'Vista/modulos/practicoBootsrap.php';
        break;

        case "ajax4":
        include_once 'Vista/modulos/ajax/ej4.php';
        break;

        case "ajax5":
        include_once 'Vista/modulos/practicoBootsrap.php';
        break;

        case "ajax6":
        include_once 'Vista/modulos/ajax/ej6.php';
        break;

        case "ajax7":
        include_once 'Vista/modulos/ajax/ej7.php';
        break;
    }

  } else {

    include_once 'Vista/modulos/inicio.php';

  }

  ?>

</div>

  <div class="footer">

      <div class="card text-center">
        <div class="card-header">
          Footer
        </div>
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div>

  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="Vista/js/practicoAjax.js"></script>
  </body>
</html>
