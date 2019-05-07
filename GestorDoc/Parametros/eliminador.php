<?php
    include('conexion.php');
    $consultas= new Consultas();
    $id=$_POST['id'];
    $tabla=$_POST['tabla'];
    if((isset($id))&&(isset($tabla))){
        $consultas->eliminarDato($tabla,'id',$id);
    }
    echo 1;
 ?>
