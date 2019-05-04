<?php
    include('conexion.php');
    $consultas=new Consultas();
    $tipo=$_POST['tipo'];
    $tabla=$_POST['tabla'];
    $campos=$_POST['campos'];
    $datos=$_POST['datos'];
    $consultas->insertarDato($tabla,$campos,$datos);
    $id=$consultas->consultarDatos('id',$tabla,"ORDER BY id DESC");
    $res=$id->fetch_array(MYSQLI_NUM);
    $res=$res[0];
    echo $res;




 ?>
