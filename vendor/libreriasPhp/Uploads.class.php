<?php
/*************************************
Clase Upload
clase que maneja el upload de archivos
al servidor.

Autor: Melquisedec Wilchez ©2006
mail: melquisedecwt@yahoo.com
*************************************/
class Uploads{
	var $maxtamano;
	var $carpeta;
	var $extensiones;
	var $campoform;
	var $errores;
	var $strerror;
	var $tipo;
	var $tamano;
	
	function Uploads(){
		$this->extensiones = array();
		$this->errores = array();
		$this->maxtamano = 0;
		$this->carpeta = "./";
		$this->strerror = "";
		$this->tipo = "";
		$this->tamano = 0;
	}
	
	function setExtensiones($ext){
		if(strlen($ext) > 0){
			$arrExt = explode(",",$ext);
			for($i = 0;$i < count($arrExt);$i++){
				$arrExt[$i] = trim($arrExt[$i]);
			}
			$this->extensiones = $arrExt;
		}
	}
	
	function setMaxTamano($tamano){
		//$this->maxtamano = $tamano;
		$this->maxtamano = 100000000;
	}
	
	function setCarpeta($carp,$crear){
		if($crear){
			if(!is_dir($carp)){
				if(@mkdir($carp,0777)){
					$this->carpeta = $carp;
				}else{
					$this->strerror = "No se pudo crear la carpeta.";
				}
			}
		}else{
			$this->carpeta = $carp;
		}
	}
	
	function setCampoForm($campo){
		$this->campoform = $campo;
	}
	
	function Subir(){
		$sub = true;
		if(is_uploaded_file(@$_FILES[$this->campoform]['tmp_name']) && @$_FILES[$this->campoform]['error'] == 0){
			if($this->esCarpeta() && $this->esExtension() && $this->esTamano()){
				if(@copy(@$_FILES[$this->campoform]['tmp_name'],$this->carpeta."/".@$_FILES[$this->campoform]['name'])){
					$sub = true;
				}else{
					$this->strerror .= "No se pudo copiar el archivo.";
					$sub = false;
				}
			}else{
				$sub = false;
			}
		}else{
			$this->strerror .= "No se cargo el archivo en el servidor.";
			$sub = false;
		}
		return $sub;
	}
	
	function verErrores(){
		$this->errores = explode(".",$this->strerror);
		return $this->errores;
	}
	
	function esCarpeta(){
		$err = true;
		if(!is_dir($this->carpeta) && is_writeable($this->carpeta)){
			$this->strerror .= "Carpeta de destino no valida.";
			$err = false;
		}
		return $err;
	}
	
	function esExtension(){
		$err = true;
		$this->getExtension();
		if(!in_array($this->tipo, $this->extensiones) && count($this->extensiones) > 0){
			$this->strerror .= "Extensi&oacute;n de archivo no valida.";
			$err = false;
		}
		return $err;
	}
	
	function esTamano(){
		$err = true;
		if(@$_FILES[$this->campoform]['size'] > $this->maxtamano){
			$this->strerror .= "Tama&ntilde;o de archivo muy grande <b>".@$_FILES[$this->campoform]['size']."bytes</b>, debe ser menor o igual a <b>" . $this->maxtamano."bytes</b>.";
			$err = false;
		}
		return $err;
	}
	
	function getExtension(){
		$this->tipo = explode(".",@$_FILES[$this->campoform]['name']);
		$this->tipo = strtolower($this->tipo[count($this->tipo)-1]);
		return $this->tipo;
	}
	
	function getTamano(){
		return @$_FILES[$this->campoform]['size'];
	}
	
	function getArchivoSub(){
		return $this->carpeta."/".@$_FILES[$this->campoform]['name'];
	}
	
	function getNombreArchivo(){
		return @$_FILES[$this->campoform]['name'];
	}
}
?>