<?php
session_start();

//require("funciones.php");
$usuario = "root";
$contrasena = "123";
$servidor = "localhost";
$basededatos = "practicaphp1";

$conexion = mysqli_connect( $servidor, $usuario, $contrasena ) or die ("No se ha podido conectar al servidor de Base de datos";
$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );;

//------------------------------------------------------------------------------------------------------
//	TAMAÑO DE LA IMAGENES REDIMENCIONADAS
$ima_ancho = 220;
$ima_alto = 180;
$ima_ancho2 = 800;
$ima_alto2 = 600;
//------------------------------------------------------------------------------------------------------		

//echo "rubro: ".$_POST['xrubro'];


	if(isset($_POST['subir_img_articulo_mantenimiento']))
		{
		require_once("Uploads.class.php");
		require_once("Imagenes.class.php");

		$up = new Imagenes();
		$up->setExtensiones("jpg,gif,png,jpeg");
		$up->setCarpeta("fotos_articulos/",false);
		$up->setMaxTamano(10000000000);
		$up->setCampoForm("img");

		if($up->Subir())
			{
			//	sube al servidor la imagen orignial
			$up->setImagen($up->getArchivoSub());

			$datos=getimagesize($up->getArchivoSub()); 
			$imgAncho = $datos[0];  
			$imgAlto = $datos[1];
			 
			//echo "<br>ancho ".$imgAncho;
			//echo "<br>alto ".$imgAlto;
			
			$ruta_mini = "fotos_articulos/mini_";
			$ruta_grande = "fotos_articulos/";

			
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
			
			$sql = 		"UPDATE 		`mantenimiento_articulos` 
						SET 			`img` = '".$up->getNombreArchivo()."'
						WHERE 			`idma` = '" . $_SESSION['idma'] . "'";	

			mysql_query($sql) or die(mysql_error());
			//echo $sql;
			
			require_once("abm/c_articulos_mantenimiento.php");
			exit;
			}
		else
			{
			$error = $up->verErrores();
			mostrar_mensaje(implode($error));	
			exit;
			}
		}
?>  
