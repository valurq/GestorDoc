<?php
session_start();

include("Parametros/conexion.php") ;
$accesoFunciones=new Consultas() ;

// DATOS DE URL
$elegidosId = $_GET['elegidosid'] ;
$perfilid  =$_GET['perfilid'] ;

$idRegistros = explode("--",$elegidosId) ;

$campos = array('habilita') ;
$valores = '"SI"' ;

 $accesoFunciones->conexion->query("update acceso set habilita='NO' where perfil_id = '".$perfilid."'");

//RECORRE POR CADA registro SELECCIONADO
foreach ($idRegistros as $RegistroPuntual) {

      $accesoFunciones->modificarDato('acceso',$campos,$valores,'id',$RegistroPuntual);

}

  header("Location: perfiles_panel.php");

?>
