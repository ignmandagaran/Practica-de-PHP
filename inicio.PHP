<?php
session_start();

    if ((!isset($_SESSION["usuario"]))||(!isset($_SESSION["clave"]))){
       header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Auto System</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Carga de autos</div>
      <div class="list-group list-group-flush">
        <a href="carga.php" class="list-group-item list-group-item-action bg-light">Cargar</a>
        <a href="visualizacion.php" class="list-group-item list-group-item-action bg-light">Mostrar autos</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
       <div class="row">
           <div class="col-3 text-left">
            <button class="btn btn-primary" id="menu-toggle">Opciones</button>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            </div>
            <div class="col-3 text-left">
            <button class="btn btn-primary" id="" onclick="<?php /*$_SESSION["usuario"]= ""; $_SESSION["clave"]="";header('Location: index.php');*/?>">Log Out</button>
            <button class="navbar-toggler" type="button" data-toggle="" aria-controls="navbarSupportedContent">
              <span class="navbar-toggler-icon"></span>
            </button>
            </div>
            <div class="col-3 text-right"><p>Usuario: <?php echo $_SESSION["nombre_usuario"];?></p></div>
        </div>
        

      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Bienvenido</h1>
        <p>Le damos la bienvenida a su sistema completo de carga de autos. Con el, usted podra realizar rapida y de forma sencilla la carga de sus autos para su completo control.</p>
        <p>Estamos en contacto ante cualquier duda. Saludos</p>
        <div class="row">
            <div class="col-6 text-right">
               <a href="carga.php">
                <button type="button" class="btn btn-primary pull-right">Cargar otro</button>
                </a>
            </div>
            <div class="col-6 text-left">
                <button type="button" class="btn btn-primary">Mostrar autos</button>
            </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
