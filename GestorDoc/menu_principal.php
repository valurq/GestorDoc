<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
    session_start();
    include("Parametros/conexion.php");
    $consulta= new Consultas();
    include("Parametros/verificarConexion.php");


 ?>
    <head>
        <script>
            var cont=1;
            function cerrar() {
              window.location='cerrar_app.php'
            }

        </script>

        <script
              src="https://code.jquery.com/jquery-3.4.0.js"
              integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
              crossorigin="anonymous">
        </script>

        <script type="text/javascript" src="Js/funciones.js"></script>


        <link rel="stylesheet" href="CSS/menu.css">
        <meta charset="utf-8">
        <title>SGD-VALURQ SRL</title>
    </head>

    <body style="">
        <div class="menu-contenedor">
            <div class="lateral-izquierdo">
                <div id="logo"></div>
                <div id="menu-items">

                </div>
            </div>
            <div class="superior">
                <div id="logo-empresa"></div>
                <div id="usuario"></div>
            </div>
            <div class="area-trabajo">
                <iframe src="" frameborder="0" name="frame-trabajo" id="frame-trabajo"></iframe>
            </div>
        </div>
        <input type="button" id="cerrar" value="cerrar" onclick = "cerrar();"  style="position:absolute;left:19px;top:20px;z-index:6">
    </body>
    <?php
        $menu=$consulta->consultarMenu($_SESSION['idUsu']);

        while ($fila=mysqli_fetch_array($menu)) {
                echo "<script>crearMenu('".$fila[0]."','".$fila[1]."','".$fila[2]."','".$fila[3]."')</script>";
        }

     ?>


</html>
