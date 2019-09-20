<?php
session_start();
?>
<link href="../estilo.css" rel="stylesheet" type="text/css" />

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
	margin-top: 0px;
	margin-left: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></html>
</head>

<?php
require_once("conectar_base.php");
require_once("funciones.php");


//-----------------------------------------------------------
$color1 = "ffffff";
$color2 = "#F5F5F5";
$color = $color2;
//-----------------------------------------------------------	
	
	
	
if(isset($_POST['subir_img']))
	{
	//	sigue el mismo $_SESSION['imagen_idelemento']
	}	
else
	{
	if(isset($_GET['idei']))
		{
		//	sigue el mismo $_SESSION['imagen_idelemento']
		}
	else
		{
		$_SESSION['imagen_idelemento'] = desencriptar($_GET['idelemento']);
		}
	}
//----------------------------------------------------------------------------------------------------------		
$sql = "SELECT * FROM elementos_img WHERE idelemento = '".$_SESSION['imagen_idelemento']."'";
$resultados = mysql_query($sql) or die(mysql_error());
//echo $sql;
//----------------------------------------------------------------------------------------------------------	
?>




			
<link href="estilo_admin.css" rel="stylesheet" type="text/css" />





<br />
<table width="1150" border="0" align="center" cellspacing="0" bgcolor="#1FA67A">
  <tr>
    <td width="499" height="50" class="texto_form_titulo"><div align="left" class="texto_form_titulo">&nbsp;&nbsp;&nbsp;&nbsp;Elemento:<span class="texto_form_titulo"> <?php echo retornar_elemento($_SESSION['imagen_idelemento']);?>&nbsp;</span></div></td>
    <td width="647" height="50" class="texto_form_titulo"><div align="right"></div></td>
  </tr>
</table>
<br />
<table width="1150" border="1" align="center" cellspacing="0" bordercolor="#1FA67A">
  <tr>
    <td height="40"><form action="index.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table width="1100" border="0" align="center" cellspacing="0">
        <tr>
          <td width="8">&nbsp;</td>
          <td width="385"><span class="texto_form_label_panel">
            <input name="img" type="file" class="textbox" id="img" size="50" />
          </span></td>
          <td width="607">&nbsp;</td>
          <td width="92"><span class="texto_form_label_panel">
            <input name="subir_img" type="submit" class="textbox" id="subir_img2" value="Guardar" />
          </span></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>



<br />
<table width="1150"  border="1" align="center" cellspacing="0" bordercolor="#1FA67A">
  

		<?php
		while($p = mysql_fetch_array($resultados)) 
			{	
			if ($color==$color2)
				{
				$color=$color1;
				}
			else
				{
				$color=$color2;
				}	
		?>



  <tr bgcolor="<?php echo $color;?>">
    <td width="155" height="25" bgcolor="<?php echo $color;?>"><div align="center"> <a href="index.php?p=e_imagen_elemento&amp;idei=<?php echo encriptar($p['idei']); ?>" 	
			onclick="return confirmar('Desea eliminar el registro seleccionado?')"> <img src="iconos/eliminar.png" alt="eliminar" width="24" height="24" border="0"/></a> </div></td>
    <td width="985" bgcolor="<?php echo $color;?>">
      
      
      <div align="left">
        <?php
	$ruta_mini = "fotos_elementos/mini_";
	$ruta_grande = "fotos_elementos/";
				
	$datos=getimagesize($ruta_mini.$p['imagen']); 
	$imgAncho = $datos[0];  
	$imgAlto = $datos[1]; 


	//echo "ancho ".$imgAncho;  
	//echo "alto ".$imgAlto; 	


	if($imgAncho > $imgAlto)
		{
		?>
        <img src="<?php echo $ruta_mini.$p['imagen']; ?>" width="110" height="90" />
        <?php
		}
	else
		{
		?>
        <img src="<?php echo $ruta_mini.$p['imagen']; ?>" width="90" height="110" />
        <?php				
		}
		?>
      </div></td></tr>
			<?php
			} 		//	CIERRO WHILE
			

			?>  
</table>



<br />
<br />
