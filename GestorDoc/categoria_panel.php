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
            <input type="button" name="Nuevo" value="Nuevo">
            <input type="button" name="Editar" value="Editar">
            <input type="button" name="Eliminar" value="Eliminar">
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTabla($cabecera,$campos,'remision_enviada');?>
        </div>
    </body>

</html>
