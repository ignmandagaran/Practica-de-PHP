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
       <br><br><br>
        <div class="row row h-100 justify-content-center align-items-center">
           <aside class="col-sm-4">
                <div class="card">
                    <article class="card-body">
                        <a href="" class="float-right btn btn-outline-primary">Registrarse</a>
                        <h4 class="card-title mb-4 mt-1">Iniciar Sesión</h4>
                        <form method="post" action="login.php" enctype="multipart/form-data" name="logueo" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label>Usuario:</label>
                                <input name="usuario" class="form-control" placeholder="Ingrese su usuario" type="text">
                            </div> <!-- form-group// -->
                            <div class="form-group">
                                <a class="float-right" href="#">La olvidaste?</a>
                                <label for="password">Contraseña:</label>
                                <input class="form-control" placeholder="******" type="password" name="clave">
                            </div> <!-- form-group// --> 
                            <div class="form-group"> 
                            <div class="checkbox">
                              <label> <input type="checkbox">Guardar contraseña</label>
                            </div> <!-- checkbox .// -->
                            </div> <!-- form-group// -->  
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" > Login </button>
                            </div> <!-- form-group// -->
                        </form>
                    </article>
                </div>
            </aside>
        </div>
        
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    
    function validateForm() {
      var usuario = document.forms["logueo"]["usuario"].value;
      var clave = document.forms["logueo"]["clave"].value;
      if ((usuario == "")||(clave == "")) {
        alert("Contraseña o usuario no ingresados!");
        return false;
      }
    }

  </script>

</body>

</html>