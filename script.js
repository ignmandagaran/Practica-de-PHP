<?php
session_start();
$_session['var']='ignacio';
echo $_session ['var'];
require('config.php');
//
$error=false;
//
// Validar entradas
//
if (!isset($_POST["patente"])) {
    $error=true;
    echo "Error: Campo de patente vacio";
    }
if (!isset($_POST["marca"])){
    $error=true;
    echo "Error: Campo de marca vacio";    
    }
if (!isset($_POST["color"])){
    $error=true;
    echo "Error: Campo de color vacio";
    }
if (!isset($_POST["kilometros"]) || !is_numeric($_POST["kilometros"])){
    $error=true;
    echo "Error: Campo de kilometros vacio o valor no numerico";    
    }
if (!isset($_POST["modelo"]) || !is_numeric($_POST["modelo"])){
    $error=true;
    echo "Error: Campo modelo vacio o valor no numerico";    
    }
//
if(!$error) { // Si no hubo error, proceder
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
    $sql = "INSERT INTO vehiculos (patente, marca, color, km, modelo)
            VALUES ('$patente', '$marca', '$color', $kilometros, $modelo )";

    // Ejecutar y validar el comando SQL 
    if ($mysqli->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    
    $mysqli->close();  // Cerrar conexión
}

    echo "<BR><BR>";
    echo "<center><a href='form.html'>Volver a la carga de datos</a></center>"
?>