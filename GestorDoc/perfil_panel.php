<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['Perfil','Elimina?','Modifica?','Notas','F.creacion'];
$campos=['perfil','elimina_doc','modifica_doc','substr(comentario,1,40)','fecreacion'];

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

    <body style="background-color:white" >
      <!--============================================================================= -->
      <!--CAMPO OCULTO UTILIZADO PARA LA EDICION -->
      <!--============================================================================= -->
              <form id="formularioMultiuso" action="" method="post">
                  <input type="hidden" name="seleccionado" id="seleccionado" value="0">
              </form>
      <!--============================================================================= -->
        <div class="wpmd" id="text1" style="position:absolute; overflow:hidden; left:10px; top:10px; width:224px; height:22px; z-index:1">
              <font color="#808080" class="ws12"><B>PANEL DE PERFILES</B></font>
        </div>
<br><br>
        <div class="menu-panel" >
            <input type="button" name="Nuevo" onclick = "location='perfil_form.php';" value="Nuevo">
            <input type="button" name="Editar" value="Editar" onclick="editar('perfil_form.php')" >
            <input type="button" name="Eliminar" value="Eliminar" onclick="eliminar('perfil')" >
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'perfil');?>
        </div>

    </body>

</html>
