<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
    session_start();
    include("Parametros/conexion.php");
    $consulta= new Consultas();
    $campos=array('id','perfil_id','usuario','pass');
/*
echo "*id ".$_SESSION['idUSu']."*<br>" ;
echo "*perfil ".$_SESSION['perfil']."*<br>" ;
echo "*usu ".$_SESSION['usuario']."*<br>" ;
echo "*pass ".$_SESSION['contra']."*<br>" ;*/

    $resultado=$consulta->consultarDatos($campos,'usuario',"","usuario",$_SESSION['usuario'] );
    $resultado=$resultado->fetch_array(MYSQLI_NUM);
    //echo $resultado[1]."/".$_SESSION['perfil']."--".$_SESSION['usuario']."/".$resultado[2]."--".$_SESSION['contra']."/".$resultado[3] ;


    if((($_SESSION['perfil']!=$resultado[1]) || ($_SESSION['usuario']!=$resultado[2]) || ($_SESSION['contra']!=$resultado[3]))){
        session_unset();
        session_write_close();
        echo "<script>window.location='login.php'</script>";
    }


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

    </body>
    <?php
        $menu=$consulta->consultarMenu($_SESSION['perfil']);

        while ($fila=mysqli_fetch_array($menu)) {
                echo "<script>crearMenu('".$fila[0]."','".$fila[1]."','".$fila[2]."','".$fila[3]."')</script>";
        }

     ?>
</html>
