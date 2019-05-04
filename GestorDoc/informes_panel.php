<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['Categoria','Titulo de reporte','Observacion','URL'];
$campos=['(select cat_informe from cat_informes where id = cat_informes_id)','titulo','substr(obs,1,50)','url'  ];

?>
<html lang="en" dir="ltr">

    <head>
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

        <div class="menu-panel" >
            <input type="button" name="Nuevo" onclick = "location='informes_form.php';" value="Nuevo">
            <input type="button" name="Editar" value="Editar">
            <input type="button" name="Eliminar" value="Eliminar">
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'informes');?>
        </div>

    </body>

</html>
