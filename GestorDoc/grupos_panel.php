<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['Grupo','Proposito','Observacion'];
$campos=['grupo','proposito','substr(obs,1,40)'];

?>
<html lang="en" dir="ltr">

    <head>

      <script
        src="https://code.jquery.com/jquery-3.4.0.js"
        integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        crossorigin="anonymous">
    </script>
      <script type="text/javascript" src="Js/funciones.js"></script>

        <script type="text/javascript">
            function seleccionarFila(id){
                if(document.getElementById('seleccionado').value!=''){
                    var anterior=document.getElementById('seleccionado').value;
                    document.getElementById(anterior).style.backgroundColor='white';
                }
                document.getElementById(id).style.backgroundColor='red';
                document.getElementById('seleccionado').value=id;
            }
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

    <body>
        <form class="" action="index.html" method="post">
            <input type="hidden" name="seleccionado" id="seleccionado">
        </form>

        <div class="wpmd" id="text1" style="position:absolute; overflow:hidden; left:10px; top:10px; width:224px; height:22px; z-index:1">
              <font color="#808080" class="ws12"><B>PANEL DE GRUPOS</B></font>
        </div>
<br><br>
        <div class="menu-panel" >
            <input type="button" name="Nuevo" onclick = "location='grupos_form.php';"  value="Nuevo">
            <input type="button" name="Editar" value="Editar">
            <input type="button" name="Eliminar" onclick="eliminar('grupos')" value="Eliminar">
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'grupos');?>
        </div>

    </body>

</html>
