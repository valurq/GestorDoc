<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
    include("Parametros/conexion.php");
    $consulta= new Consultas();
 ?>
    <head>
        <script>
            var cont=1;
        </script>
        <script
              src="https://code.jquery.com/jquery-3.4.0.js"
              integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
              crossorigin="anonymous"></script>
        <script type="text/javascript" src="Js/funciones.js"></script>
        <link rel="stylesheet" href="CSS/menu.css">
        <meta charset="utf-8">
        <title></title>
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
                <iframe src="" frameborder="0"></iframe>
            </div>
        </div>

    </body>
    <?php
/*      $menu=array(
            array("'menu_administracion.php'","'iconotest.png'","'Administracion'",'1'),
            array("'menu_administracion.php'","'iconotest.png'","'Operacion'",'1'),
            array("'menu_administracion.php'","'iconotest.png'","'Negocios'",'1'),
            array("'menu_administracion.php'","'iconotest.png'","'Movimientos'",'0'),
            array("'menu_administracion.php'","'iconotest.png'","'Pruebas'",'1')
        );*/
        $menu=$consulta->consultarMenu(4);
        while ($fila=mysqli_fetch_array($menu)) {
                echo "<script>crearMenu('".$fila[0]."','".$fila[1]."','".$fila[2]."','".$fila[3]."')</script>";
        }


        /*
        <a class="url" href="#">
            <div class="menu-opcion">
                <div class="icono-opcion"></div>
                <div class="titulo-opcion">Administracion</div>
            </div>
        </a>
        <a class="url" href="#">
            <div class="menu-opcion">
                <div class="icono-opcion"></div>
                <div class="titulo-opcion">Administracion</div>
            </div>
        </a>
        <a class="url" href="#">
            <div class="menu-opcion desactivado">
                <div class="icono-opcion"></div>
                <div class="titulo-opcion">Administracion</div>
            </div>
        </a>
        <a class="url" href="#">
            <div class="menu-opcion">
                <div class="icono-opcion"></div>
                <div class="titulo-opcion">Administracion</div>
            </div>
        </a>


        */
     ?>
</html>
