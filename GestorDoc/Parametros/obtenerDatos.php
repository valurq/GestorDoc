<?php
include("conexion.php");
@$consultas=new Consultas();
@$campos=$_POST['campos'];
@$tabla=$_POST['tabla'];
@$campoC=$_POST['campoCondicion'];
@$valor=$_POST['valores'];
$resultado=array(array($campos));
$datos=$consultas->consultarDatosQ($campos,$tabla,"",$campoC,$valor);
while ($fila=$datos->fetch_row()) {
    array_push($resultado,$fila);
}
array_shift($resultado);
echo json_encode(array_values($resultado),JSON_PRETTY_PRINT);

?>
