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
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.0/font/css/open-iconic-bootstrap.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="vendor/bootbox/bootbox.min.js"></script>
  <script type="text/javascript" src="scripts/deleteRecords.js"></script>
  <script language="JavaScript"> 
      function confirmar ( mensaje ) { return confirm( mensaje ); } 
  </script>

</head>

<body>
 
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Carga de autos</div>
      <div class="list-group list-group-flush">
        <a href="carga.php" class="list-group-item list-group-item-action bg-light">Cargar</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Mostrar autos</a>
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
        <h1 class="mt-4">Autos cargados</h1>
        <p>A continuacion podra visualizar los autos cargados, eliminarlos y editarlos.</p>
        <?php $link = new PDO('mysql:host=localhost;dbname=practicaphp1', 'root', '123');?>
        <div class="table-responsive">
            <table class="table">
               <thead>
                   <tr>
                      <th scope="col"></th>
                      <th scope="col">ID</th>
                      <th scope="col">Patente</th>
                      <th scope="col">Marca</th>
                      <th scope="col">Color</th>
                      <th scope="col">Kilometros</th>
                      <th scope="col">Modelo</th>
                      <th scope="col"></th>
                   </tr>
               </thead>
               <tbody>
                <?php foreach ($link->query('SELECT * from vehiculos v INNER JOIN colores c ON v.id_color = c.id') as $row){ // aca puedes hacer la consulta e iterarla con each. ?>
                <tr>
                    <th scope="col"><a href="modificar.php?id=<?php echo $row["idvehiculo"]?>"><span class="oi oi-pencil"></span></a></th>
                    <td><?php echo $row['idvehiculo']?></td>
                    <td><?php echo $row['patente'] ?></td>
                    <td><?php echo $row['marca'] ?></td>
                    <td><?php echo $row['nombre']?></td>
                    <td><?php echo $row['km'] ?></td>
                    <td><?php echo $row['modelo'] ?></td>
                    <th scope="col"><a href="visualizacion.php?id=<?php echo $row['idvehiculo']?>" onclick="return confirmar ('Desea eliminar el registro seleccionado?')"><span class="oi oi-trash"></span></a></th>    
                </tr>
                <?php
                    }
                ?>
                <?php
    
                if(isset($_GET["id"])){
                    $link->query("DELETE FROM vehiculos WHERE idvehiculo='".$_GET["id"]."'");
                    echo '<meta http-equiv="refresh" content="0;visualizacion.php">';
                }
                  
                if((isset($_POST["patente"]))&&(isset($_POST["marca"]))&&(isset($_POST["kilometros"]))&&(isset($_POST["modelo"]))&&(isset($_GET["id"]))){
                    echo 'Hasta aca llega bien';
                    $link->query("UPDATE `vehiculos` SET `patente` = '".$_POST["patente"]."', `marca` = '".$_POST["marca"]."', `km` = '".$_POST["kilometros"]."'. `modelo` = '".$_POST["modelo"]."' WHERE `vehiculos`.`idvehiculo` = '".$_GET["id"]."'");
                    echo '<meta http-equiv="refresh" content="0;visualizacion.php">';
                }
                ?>
                </tbody>
            </table>
          </div>
      </div>
        
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper id_eliminar=<?php echo $row['idvehiculo']?> -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
      $('a[href$="#myModal"').on("shown.bs.modal", function () {
  $("#myInput").trigger('focus')
})
  </script>

</body>

</html>