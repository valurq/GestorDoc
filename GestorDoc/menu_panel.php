<!DOCTYPE html>
<?php
session_start() ;
include("Parametros/conexion.php");
include("Parametros/verificarConexion.php");

$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['Titulo','URL','Posicion','Icono'];
$campos=['titulo_menu','link_acceso','posicion','icono'  ];

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
              <font color="#808080" class="ws12"><B>PANEL DE MENUES</B></font>
        </div>
<br><br>
        <div class="menu-panel" >
            <input type="button" class="boton_panel" name="Nuevo" onclick = "location='menu_form.php';" value="Nuevo">
            <input type="button" class="boton_panel" name="Editar" value="Editar" onclick="editar('menu_form.php')">
            <input type="button" class="boton_panel" name="Eliminar" value="Eliminar" onclick="eliminar('menu_opcion')" >
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'menu_opcion');?>
        </div>

    </body>

</html>
