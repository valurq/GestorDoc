<?php
    include('conexion.php');
    $consultas= new Consultas();
    $camposRes=$_POST['camposResultado'];
    $valor=$_POST['dato'];
    $tabla=$_POST['tabla'];
    $campo=$_POST['campoBusqueda'];
    array_unshift($camposRes,'id');
    $resultado=array(array($camposRes));

    $datos=$consultas->buscarDato($camposRes,$tabla,$campo,$valor);
    while ($fila=$datos->fetch_row()) {
        array_push($resultado,$fila);
    }
    //$resultado=$resultado->fetch_assoc();
    //$resultado=array_shift($resultado);
    echo json_encode(array_values($resultado),JSON_PRETTY_PRINT);




 ?>
