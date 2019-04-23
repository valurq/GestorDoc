<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();
$cabecera=['Categoria','Fecha de Creacion','Comentario'];

//PRUEBAS CON DATOS
$cabecera=['fecha','numero','N. Oportunidad','Cliente','Destino','id'];
$campos=['fecha','numero','(Select numero from oportunidad where oportunidad.id = remision_enviada.oportunidad_id)','dsc_cliente','(select deposito from deposito where deposito.id= remision_enviada.deposito_id)'];

?>
<html lang="en" dir="ltr">

    <head>
        <script
			  src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script>
        <script type="text/javascript" src="Js/funciones.js"></script>
        <meta charset="utf-8">
        <style media="screen">
            .menu-panel{
                width: 100%
            }
            .mostrar-tabla{
                width: 100%;
            }
        </style>
        <title>Categorias</title>
    </head>

    <body>
        <form id="formularioMultiuso" action="" method="post">
            <input type="hidden" name="seleccionado" id="seleccionado">
        </form>

        <div class="menu-panel" >
            <input type="button" name="Nuevo" value="Nuevo">
            <input type="button" name="Editar" value="Editar">
            <input type="button" name="Eliminar" value="Eliminar" onclick="eliminar('remision_enviada')">
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'remision_enviada');?>
        </div>
    </body>

</html>
