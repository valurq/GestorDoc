<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['Descripcion','Observaciones','F.creacion'];
$campos=['mueble','substr(obs,1,40)','fecreacion'];

?>
<html lang="en" dir="ltr">

    <head>
          <link rel="stylesheet" href="CSS/popup.css">
          <link rel="stylesheet" href="CSS/paneles.css">
      <script
        src="https://code.jquery.com/jquery-3.4.0.js"
        integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        crossorigin="anonymous">
    </script>
      <script type="text/javascript" src="Js/funciones.js"></script>
      <script type="text/javascript">
      // para busqueda en paneles
          var campos=['mueble','substr(obs,1,40)','fecreacion'];
      </script>

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
      <!--============================================================================= -->
      <!--CAMPO OCULTO UTILIZADO PARA LA EDICION -->
    <!--============================================================================= -->
        <form id="formularioMultiuso" action="" method="post">
            <input type="hidden" name="seleccionado" id="seleccionado" value="0">
        </form>
    <!--============================================================================= -->
<div class="menu-panel" >
    <br><br>
    <input type="text" name="buscador" id="buscador" onkeyup="buscarTablaPaneles(campos, this.value ,'ubi_mueble','mueble')">
      <div class="wpmd" id="text1" style="position:absolute; overflow:hidden; left:10px; top:10px; width:224px; height:22px; z-index:1">
            <font color="#808080" class="ws12"><B>PANEL DE MUEBLES</B></font>
      </div>

            <input type="button" class="boton_panel" name="Nuevo" onclick = "location='muebles_form.php';" value="Nuevo">
            <input type="button" class="boton_panel" name="Editar" value="Editar" onclick="editar('muebles_form.php')" >
            <input type="button" class="boton_panel" name="Eliminar" value="Eliminar" onclick="eliminar('ubi_mueble')" >
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'ubi_mueble');?>
        </div>

    </body>

</html>
