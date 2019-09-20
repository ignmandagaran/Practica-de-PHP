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
        require('config.php');

        $usuario = "root";
        $contrasena = "123";
        $servidor = "localhost";
        $basededatos = "practicaphp1";

        $conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("No se ha podido conectar al servidor de Base de datos");
        $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );

                                                                               
            $patente = $_POST["patente"];
            $marca = $_POST["marca"];
            $color = $_POST["color"]; 
            $kilometros =  $_POST["kilometros"];
            $modelo =  $_POST["modelo"];
          
          
        $error=true;
        //
        // Validar entradas
        //
       /*   if (!isset($_POST["patente"])) {
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

        
         <?php*/
          
        if ($error){
            // crear cadena de inserción SQL
            $sql = "INSERT INTO vehiculos (patente, marca, id_color, km, modelo)
                    VALUES ('$patente', '$marca', '$color', $kilometros, $modelo )";
            // Ejecutar y validar el comando SQL 
            mysqli_query( $conexion, $sql ) or die ( "Primer carga: Algo ha ido mal en la consulta a la base de datos");
           }
                                                                               
        //------------------------------------------------------------------------------------------------------
        //	TAMAÑO DE LA IMAGENES REDIMENCIONADAS
        $ima_ancho = 220;
        $ima_alto = 180;
        $ima_ancho2 = 800;
        $ima_alto2 = 600;
        //------------------------------------------------------------------------------------------------------                                                                               
            require_once("vendor/libreriasPhp/Uploads.class.php");
            require_once("vendor/libreriasPhp/Imagenes.class.php");

            $up = new Imagenes();
            $up->setExtensiones("jpg,gif,png,jpeg");
            $up->setCarpeta("imagenes/",false);
            $up->setMaxTamano(10000000000);
            $up->setCampoForm("img");
            
            if($up->Subir())
			{
                echo "subir";
			//	sube al servidor la imagen orignial
			$up->setImagen($up->getArchivoSub());

			$datos=getimagesize($up->getArchivoSub()); 
			$imgAncho = $datos[0];  
			$imgAlto = $datos[1];
			 
			//echo "<br>ancho ".$imgAncho;
			//echo "<br>alto ".$imgAlto;
			
			$ruta_mini = "imagenes/mini_";
			$ruta_grande = "imagenes/";
            
            if($imgAncho < $imgAlto)
				{
				//	sube al servidor la imagen redimensionada
				$up->redimensionarImg($ruta_mini.$up->getNombreArchivo(), $ima_alto, $ima_ancho);
				$up->redimensionarImg($ruta_grande."1".$up->getNombreArchivo(), $ima_alto2, $ima_ancho2);
				//echo "imagen vertical";
				}
			else
				{
				//	sube al servidor la imagen redimensionada
				$up->redimensionarImg($ruta_mini.$up->getNombreArchivo(), $ima_ancho, $ima_alto);
				$up->redimensionarImg($ruta_grande."1".$up->getNombreArchivo(), $ima_ancho2, $ima_alto2);
				//echo "imagen horizontal";
				}
            
            //	elimina del servidor la imagen origial
			unlink ($ruta_grande.$up->getNombreArchivo());
			
			
			//	renombra la imagen redimencionada
			rename($ruta_grande."1".$up->getNombreArchivo(), $ruta_grande.$up->getNombreArchivo());
            
            $sql = 		"INSERT INTO 	`imagenes` (`id`, `id_vehiculo`, `img`)
						VALUES 			(NULL, LAST_INSERT_ID(), '".$up->getNombreArchivo()."')";	
            echo $sql;
			mysql_query($sql) or die(mysql_error());

            mysqli_close( $conexion );
            }
        ?>
        <div class="alert alert-primary m-4" role="primary">Auto cargado con exito!</div>
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