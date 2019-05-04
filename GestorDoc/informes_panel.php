<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['Categoria','Titulo de reporte','Observacion','URL'];
$campos=['(select cat_informe from cat_informes where id = cat_informes_id)','titulo','substr(obs,1,40)','url'  ];

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
              <font color="#808080" class="ws12"><B>PANEL DE INFORMES</B></font>
        </div>
        <br><br>
        
        <div class="menu-panel" >
            <input type="button" name="Nuevo" onclick = "location='informes_form.php';" value="Nuevo">
            <input type="button" name="Editar" value="Editar">
            <input type="button" name="Eliminar" value="Eliminar" onclick="eliminar('informes')" >
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'informes');?>
        </div>

    </body>

</html>
