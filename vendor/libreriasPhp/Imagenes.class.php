<?php
/*************************************
Clase Imagenes
clase que edita imagenes
del servidor.

Autor: Melquisedec Wilchez ©2006
mail: melquisedecwt@yahoo.com
*************************************/
class Imagenes extends Uploads{
	var $imagen;
	var $ancho;
	var $alto;
	var $tamaño;
	var $calidad;
	
	function Imagenes(){
		parent::Uploads();
		$this->calidad = 85;
	}
	
	function setImagen($src){
		$this->imagen = $src;
		$this->tamaño = getimagesize($this->imagen);
		$this->ancho = $this->tamaño[0];
		$this->alto = $this->tamaño[1];
	}
	
	function setCalidad($cal){
		$this->calidad = $cal;
	}
	
	function getAnchoImg(){
		return $this->ancho;
	}
	
	function getAltoImg(){
		return $this->alto;
	}
	
	function redimensionarImg($nuevaimagen,$nuevoancho,$nuevoalto){
		if(!file_exists($nuevaimagen)){
			if($nuevoancho == 0 || $nuevoancho == ""){
				$nuevoancho = round($this->ancho * ($nuevoalto / $this->alto));
			}
			if($nuevoalto == 0 || $nuevoancho == ""){
				$nuevoalto = round($this->alto * ($nuevoancho / $this->ancho));
			}
			$this->ancho = $nuevoancho;
			$this->alto = $nuevoalto;
			switch($this->getExtension()){
				case "gif":
					$img = imagecreatefromgif($this->imagen);
 					$thumb = imagecreatetruecolor($nuevoancho,$nuevoalto);
 					imagecopyresampled($thumb,$img,0,0,0,0,$nuevoancho, $nuevoalto,imagesx($img),imagesy($img));
 					imagegif($thumb,$nuevaimagen);
				break;
				case "png":
					$img = imagecreatefrompng($this->imagen);
 					$thumb = imagecreatetruecolor($nuevoancho,$nuevoalto);
 					imagecopyresampled($thumb,$img,0,0,0,0,$nuevoancho, $nuevoalto,imagesx($img),imagesy($img));
 					imagegif($thumb,$nuevaimagen);
				break;
				case "jpg":
					$img = imagecreatefromjpeg($this->imagen);
 					$thumb = imagecreatetruecolor($nuevoancho,$nuevoalto);
 					imagecopyresampled($thumb,$img,0,0,0,0,$nuevoancho, $nuevoalto,imagesx($img),imagesy($img));
 					imagejpeg($thumb,$nuevaimagen,$this->calidad);
				break;
				case "jpeg":
					$img = imagecreatefromjpeg($this->imagen);
 					$thumb = imagecreatetruecolor($nuevoancho,$nuevoalto);
 					imagecopyresampled($thumb,$img,0,0,0,0,$nuevoancho, $nuevoalto,imagesx($img),imagesy($img));
 					imagejpeg($thumb,$nuevaimagen,$this->calidad);
				break;
			}
		}
	}
}
?>