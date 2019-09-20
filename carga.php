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
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Carga de autos</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Cargar</a>
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
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Carga de autos</h1>
        <p>Complete el formulario para almacenar un nuevo auto. Si desea modificar un auto ya cargado, podra realizarlo en "Mostrar autos".</p>
            <form method="post" action="cargar_vehiculo.php" enctype="multipart/form-data" name="form" id="form" onsubmit="return comprobar()">
                    
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPatente">Patente</label>
                  <input type="text" class="form-control" placeholder="Patente" name="patente">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputMarca">Marca</label>
                  <input type="text" class="form-control" placeholder="Marca" name="marca">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputKm">Kilometros</label>
                  <input type="text" class="form-control" placeholder="Kilometros" name="kilometros">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Color</label>
                  <?php
                      $link = new PDO('mysql:host=localhost;dbname=practicaphp1', 'root', '123');
                      $sql = "SELECT * from colores";
                    ?>
                  <select id="inputState" class="form-control" name="color">
                    <option value="0" selected>Elegir</option>
                    <?php 
                      foreach ($link->query($sql) as $row){
                    echo '<option value="'.$row[id].'">'.$row[nombre].'</option>';
                        }
                    ?>
                    <input type="hidden" name="id_color" value="">
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Año</label>
                  <input type="text" class="form-control" name="modelo" maxlength="4">
                </div>
                <div class="form-group col-md-12">
                  <label for="exampleFormControlFile1">Imagen</label>
                  <input id="imagen" type="file" class="form-control-file" id="exampleFormControlFile1" name="user_image" accept="image/*">
                </div>
              </div>
              <button type="submit" value="Guardar" class="btn btn-primary">Aceptar</button>
              <button type="submit" class="btn btn-primary">Borrar todo</button>
            </form>
        
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->


</body>

</html>
