<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
  session_start() ;
    include("Parametros/conexion.php");
    include("Parametros/verificarConexion.php");
    $consultas=new Consultas();

?>
    <head>
      <script>
          var cont=1;
      </script>

      <script
        src="https://code.jquery.com/jquery-3.4.0.js"
        integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        crossorigin="anonymous">
      </script>

      <script type="text/javascript" src="Js/funciones.js"></script>

      <link rel="stylesheet" href="CSS/menu.css">
      <meta charset="utf-8">

       <title>VALURQ_SRL</title>
    </head>

    <body style="background-color:white">

              <div id="menu-items"> </div>

    </body>


    <?php

        $menu=$consultas->consultarInformes();
        while ($fila=mysqli_fetch_array($menu)) {
           echo "<script>crearAcceso('".$fila[0]."','".$fila[1]."')</script>";
        }

     ?>

</html>
