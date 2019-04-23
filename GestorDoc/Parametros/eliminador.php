<?php
    include('conexion.php');
    $consultas= new Consultas();
    $id=$_POST['id'];
    $origen=$_POST['origen'];
    if((isset($id))&&(isset($origen))){
        $consultas->eliminarDato($origen,'id',$id);
    }
    echo 1;




 ?>
