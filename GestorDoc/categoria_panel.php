<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// DATOS
$cabecera=['Categoria','Comentario','Fecha de Creacion'];
$campos=['categoria','substr(obs,1,40)','fecreacion'];


?>
<html lang="en" dir="ltr">

    <head>

        <script
  			  src="https://code.jquery.com/jquery-3.4.0.js"
  			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  			  crossorigin="anonymous">
      </script>
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

    <body style="background-color:white">
        <form id="formularioMultiuso" action="" method="post">
            <input type="hidden" name="seleccionado" id="seleccionado" value="0">
        </form>

        <div class="menu-panel" >
                        
                  <div class="wpmd" id="text1" style="position:absolute; overflow:hidden; left:10px; top:10px; width:224px; height:22px; z-index:1">
                        <font color="#808080" class="ws12"><B>PANEL DE CATEGORIA</B></font>
                  </div>

          <br><br>

            <input type="button" name="Nuevo" onclick = "location='categoria_form.php';" value="Nuevo">
            <input type="button" name="Editar" value="Editar" onclick="editar('categoria_form.php')">
            <input type="button" name="Eliminar" value="Eliminar" onclick="eliminar('categoria')">
        </div>

        <div class="mostrar-tabla">
            <?php
             $consultas->crearTabla($cabecera,$campos,'categoria');

            ?>
        </div>
    </body>

</html>
