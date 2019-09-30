<?php
session_start();

include("Parametros/conexion.php") ;
include("Parametros/verificarConexion.php");

$accesoFunciones=new Consultas() ;

// DATOS DE URL
$documentosid    = $_GET['documentosid'] ;
$ubi_gabetas_id  = $_GET['destino'];
$motivo          = $_GET['motivo'];

$campos = array('ubi_gabetas_id') ;
$Datos = explode("--",$documentosid) ;
$nuevoDestino = "'".$ubi_gabetas_id."'" ;
$fec_fingabeta = date('Y-m-d', time());
$mov_usuario =  $_SESSION['usuario'] ;

$campoHistorico =array('documento_id','fec_fingabeta','mov_usuario','motivo','idgabeta') ;

//RECORRE POR CADA DOCUMENTO SELECCIONADO
foreach ($Datos as $valorId) {

    if($valorId!=''){ // ACTUALIZACION DE GABETAS DE DOCUMENTOS SELECCIONADOS
      $accesoFunciones->modificarDato('documento',$campos,$nuevoDestino,'id',$valorId);
    }

//  Datos para el historico
    $DatosDocGabetas = $accesoFunciones->consultarDatos(array('ubi_gabetas_id'),'documento','','id',$valorId) ;
    $IDgabeta = $DatosDocGabetas->fetch_array(MYSQLI_BOTH);
    $HistoricoValores = "'".$valorId."','".$fec_fingabeta."','".$mov_usuario."','".$motivo."','".$IDgabeta[0]."'" ;

    if($valorId!=''){
      // Registra en historico
      $accesoFunciones->insertarDato('historico_gabeta',$campoHistorico,$HistoricoValores);
    }
}

//echo "<scrip>popup('Advertencia','Proceso realizado correctamente')  ;</script>"    ;

  header("Location: mover_panel.php");

?>
