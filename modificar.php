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
  <script type="text/javascript" src="scripts/deleteRecords.js"></script>
  
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
      <?php 
        $id = $_GET["id"]; 
        $link = new PDO('mysql:host=localhost;dbname=practicaphp1', 'root', '123');
        $sql = "SELECT * from vehiculos v INNER JOIN colores c ON v.id_color = c.id WHERE idvehiculo=".$id;
        foreach ($link->query($sql) as $row){
        ?>

      <div class="container-fluid">
        <h1 class="mt-4">Modificando Auto ID <?php echo $id?></h1>
        <p>Modifique el formulario para editar el auto seleccionado.</p>
            <form method="post" action="modificar_vehiculo.php" name="form" id="form" onsubmit="return comprobar()">
                 
              <div class="form-row">
                <div class="form-group col-md-6">
                 <label for="inputid">
                  <input type="hidden" name="idvehiculo" value="<?php echo $id?>">
                  </label>
                  <label for="inputPatente">Patente</label>
                  <input type="text" class="form-control" placeholder="Patente" name="patente" value=<?php echo $row["patente"] ?>>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputMarca">Marca</label>
                  <input type="text" class="form-control" placeholder="Marca" name="marca" value=<?php echo $row["marca"] ?>>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputKm">Kilometros</label>
                  <input type="text" class="form-control" placeholder="Kilometros" name="kilometros" value=<?php echo $row["km"] ?>>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Color</label>
                  <select id="inputState" class="form-control" name="color">
                    <?php echo '<option value="'.$row['id_color'].'">'.$row ['nombre'].'</option>'?>
                    <?php
                        }
                    ?>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Año</label>
                  <input type="text" class="form-control" name="modelo" maxlength="4" value=<?php echo $row["modelo"]?>>
                </div>
              </div>
              <button type="submit" value="Guardar" class="btn btn-primary" onclick="return confirmar('Esta seguro que quiere modificar este registro?')">Aceptar</button>
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
