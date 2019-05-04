<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

//PRUEBAS CON DATOS
$cabecera=['Categoria','Comentario','Fecha de Creacion'];
$campos=['categoria','obs','fecreacion'];

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
        <title>VALURQ_SRL</title>
    </head>

    <body>
        <form id="formularioMultiuso" action="" method="post">
            <input type="hidden" name="seleccionado" id="seleccionado">
        </form>

        <div class="menu-panel" >
            <input type="button" name="Nuevo" onclick = "location='categoria_form.php';" value="Nuevo">
            <input type="button" name="Editar" value="Editar">
            <input type="button" name="Eliminar" value="Eliminar" onclick="eliminar('categoria')">
        </div>

        <div class="mostrar-tabla">
            <?php
             $consultas->crearTabla($cabecera,$campos,'menu_opcion');
            //$consultas->crearMenuDesplegable("menus","id","titulo_menu","menu_opcion");

            ?>
        </div>
    </body>

</html>
