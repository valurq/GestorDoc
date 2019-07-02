<?php
    $campos=array('id','(select usuario from usuario where id = usuario_id)' );
    include ('conexion.php');
    $consulta=new Consultas();
    $datos=implode('#',$_POST['datos']);
    $campos=implode('#',$_POST['campos']);
    $tabla=$_POST['tabla'];
    $consulta->insertarDato($tabla,$datos,$campos);
    $datos=$consulta->consultarDatos($campos,'usuario_grupo',"",'grupos_id',$datos[0]);
//    $consulta->crearContenidoTabla
?>
