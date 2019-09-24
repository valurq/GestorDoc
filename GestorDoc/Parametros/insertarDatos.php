<?php
include('conexion.php');
$consultas=new Consultas();
$campos=$_POST['campos'];
$tabla=$_POST['tabla'];
$valores=$_POST['valores'];
$val="";
foreach ($valores as $key => $value) {
    $val.="'".$value."',";
}
$val = substr($val,0,-1);

if(isset($_POST['campos']) && isset($_POST['tabla'])&& isset($_POST['valores'])){
    $retorno=$consultas->insertarDato($tabla,$campos,$val);
    if($retorno>0){
        echo "0";
    }else{
        echo "1";
    }
}
 ?>
