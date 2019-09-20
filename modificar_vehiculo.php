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
       <!-- <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Status</a> -->
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Opciones</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
       <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
          </ul>
        </div> -->
      </nav>
      <div class="container-fluid">
        <?php
        session_start();
        require('config.php');
        //
        $error=false;
        //
        // Validar entradas
        //
          if (!isset($_POST["patente"])) {
          ?>
          <div class="alert alert-danger m-4" role="alert">
          <?php
            $error=true;
            echo 'Error: Campo de patente vacio';
            }
          if (!isset($_POST["marca"])){
          ?>
          </div>
          <div class="alert alert-danger m-4" role="alert">    
          <?php
            $error=true;
            echo "Error: Campo de marca vacio";    
            }
          if (!isset($_POST["color"])){
          ?>
          </div>
          <div class="alert alert-danger m-4" role="alert">
          <?php
            $error=true;
            echo "Error: Campo de color vacio";
            }
          if (!isset($_POST["kilometros"]) || !is_numeric($_POST["kilometros"])){
            ?>
            </div>
            <div class="alert alert-danger m-4" role="alert">
            <?php
            $error=true;
            echo "Error: Campo de kilometros vacio o valor no numerico";    
            }
          if (!isset($_POST["modelo"]) || !is_numeric($_POST["modelo"])){
            ?>
            </div>
            <div class="alert alert-danger m-4" role="alert">
            <?php
            $error=true;
            echo "Error: Campo modelo vacio o valor no numerico";    
            }
            ?>
            </div>
        
         <?php
            
          //  $nombre_img = $_FILES['imagen']['name'];
          //  $tipo = $_FILES['imagen']['type'];
           // $tamano = $_FILES['imagen']['size'];
          
         /* if () 
{
           //indicamos los formatos que permitimos subir a nuestro servidor
           if (($_FILES["imagen"]["type"] == "image/gif")
           || ($_FILES["imagen"]["type"] == "image/jpeg")
           || ($_FILES["imagen"]["type"] == "image/jpg")
           || ($_FILES["imagen"]["type"] == "image/png"))
           {
              // Ruta donde se guardarán las imágenes que subamos
              $directorio = $_SERVER['DOCUMENT_ROOT'].'/intranet/uploads/';
              // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
              move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
            } 
            else 
            {
               //si no cumple con el formato
               echo "No se puede subir una imagen con ese formato ";
            }
        } 
        else 
        {
           //si existe la variable pero se pasa del tamaño permitido
           if($nombre_img == !NULL) echo "La imagen es demasiado grande "; 
        }*/
          
      //  if(!$error&&($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 200000)) { // Si no hubo error, proceder
            $idvehiculo = $_POST["idvehiculo"];
            $patente = $_POST["patente"];
            $marca = $_POST["marca"];
            $color = $_POST["color"];
            $kilometros =  $_POST["kilometros"];
            $modelo =  $_POST["modelo"];

            // Crear objeto de conexión con la base de datos
            $mysqli = new mysqli(_DB_SERVER_,_DB_USER_,_DB_PASSWD_,_DB_NAME_);

            /* Verificar errores de conexion con la BD */
            if ($mysqli->connect_error) {
                echo "Connection failed: " . $conn->connect_error;
            }
            // crear cadena de inserción SQL
            $sql = "UPDATE `vehiculos` SET `patente` = '$patente', `marca` = '$marca', `km` = '$kilometros', `modelo` = '$modelo' WHERE `vehiculos`.`idvehiculo` = '$idvehiculo'";

            // Ejecutar y validar el comando SQL 
            if ($mysqli->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        ?>
            <div class="alert alert-primary m-4" role="primary">
            Auto cargado con exito!
           </div>
        <?php

            $mysqli->close();  // Cerrar conexión
        //}
        ?>
        <div class="row">
            <div class="col-6 text-right">
               <a href="carga.php">
                <button type="button" class="btn btn-primary pull-right">Volver a cargar</button>
                </a>
            </div>
            <div class="col-6 text-left">
               <a href="visualizacion.php">
                <button type="button" class="btn btn-primary">Mostrar autos</button>
                </a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>