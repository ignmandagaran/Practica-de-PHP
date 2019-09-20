<?php
// Incluimos el archivo conexión
require('config.php');

        $mysqli = new mysqli(_DB_SERVER_,_DB_USER_,_DB_PASSWD_,_DB_NAME_);

        /* Verificar errores de conexion con la BD */
        if ($mysqli->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
            }

require_once('db/clase.php');
// Instancia del objeto classe Login
$objLogin = new Login();
 
// Verificamos si esta logueado, caso contrario será redireccionado a la página de login
if (!$objLogin->verificar('index.php'))
    // Cerramos la verificacion
    exit;
 
// Selecionamos informacion del usuario desde MySQL
$query = mysqli_query($conectar,"SELECT * FROM usuario WHERE id_usuario = {$objLogin->getID()}");
$usuario = mysqli_fetch_object($query);
?>