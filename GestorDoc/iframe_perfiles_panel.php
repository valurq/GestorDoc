<!DOCTYPE html>

<?php

include("Parametros/conexion.php");
$consultas=new Consultas();

$elperfil = $_GET['idperfil'] ;

  $cabecera=['*','Opcion de menu'];
  $campos=['id','(SELECT titulo_menu FROM menu_opcion WHERE id = acceso.menu_opcion_id) as titulo','habilita'];
?>

<html lang="en" dir="ltr">

    <head>
          <link rel="stylesheet" href="CSS/popup.css">
          <link rel="stylesheet" href="CSS/paneles.css">
          <link rel="stylesheet" type="text/css" href="CSS/estilos.css">

              <script
        			  src="https://code.jquery.com/jquery-3.4.0.js"
        			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        			  crossorigin="anonymous">
            </script>

              <script type="text/javascript" src="Js/funciones.js"></script>

              <script type="text/javascript">
              // para busqueda en paneles
                  var campos=['id','(SELECT titulo_menu FROM menu_opcion WHERE id = acceso.menu_opcion_id) as titulo','habilita'];
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

    <body style="background-color:white" >

    <div class="mostrar-tabla">
        <?php  $consultas->crearTablaCheck_marca($cabecera,$campos,'acceso','perfil_id',$elperfil);?>
    </div>

</body>

</html>
