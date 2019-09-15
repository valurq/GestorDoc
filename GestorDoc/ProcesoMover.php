<?php
session_start();

include("Parametros/conexion.php") ;
$accesoFunciones=new Consultas() ;

// DATOS DE URL
$documentosid = $_GET['documentosid'] ;
$ubi_gabetas_id  =$_GET['destino'];

$campos = array('ubi_gabetas_id') ;
$Datos = explode("--",$documentosid) ;
$nuevoDestino = "'".$ubi_gabetas_id."'" ;

//RECORRE POR CADA DOCUMENTO SELECCIONADO
foreach ($Datos as $valorId) {

    if($valorId!=''){ // ACTUALIZACION DE GABETAS DE DOCUMENTOS SELECCIONADOS
      $accesoFunciones->modificarDato('documento',$campos,$nuevoDestino,'id',$valorId);
    }
}

//echo "<scrip>popup('Advertencia','Proceso realizado correctamente')  ;</script>"    ;
  
  header("Location: mover_panel.php");

?>
