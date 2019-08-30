
<!doctype html>
<html>
<head>

  <script type="text/ecmascript">

    function bajar(valor,destino,idvalor,iddestino)
    {
      opener.document.getElementById(destino).value=valor;
      opener.document.getElementById(iddestino).value=idvalor;
      window.close();
    }

  </script>

        <meta charset="utf-8">
        <title>Lista opciones</title>

        <style type="text/css">
            table {border-collapse:collapse}
            td {border:1px solid #E0E0E0}
        </style>

</head>

<body>
<form id="form1" name="form1" method="post">
  <table width="80%" border="0" align="left" cellpadding="0" cellspacing="0">
    <tbody>
      <tr bgcolor="#326da8">
        <td height="37" colspan="2" align="center" style="font-family:arial;font-size:22px;font-weight:bold">Lista de opciones
          <input type="hidden" name="hiddenField" id="hiddenField" value="">
        </td>
      </tr>

    </tbody>
  </table>

  <table width="80%" border="1" cellspacing="0" cellpadding="0">
    <tbody>

      <tr bgcolor="#329ea8">
        <td colspan="3" style="font-size: 16px;font-family: arial;font-weight: bold;color: #ffffff)">Opciones disponibles</td>
      </tr>

      <?php
      include("conexion.php");
      $acceso_Funciones=new Consultas();

//    PARAMETROS RECIBIDOS
      $destino = $_GET['destino'] ;
      $tabla   = $_GET['tabla'] ;
      $valor   = $_GET['valor'] ;
      $idvalor = $_GET['idvalor'] ;
      $iddestino = $_GET['iddestino'] ;
      $campoFiltro=$_GET['campoFiltro'];
      $valorFiltro=$_GET['valorFiltro'] ;

      $camposConsultar = array($valor,$idvalor) ;
      $datosConsulta=$acceso_Funciones->consultarDatos($camposConsultar,$tabla,$campoFiltro,$valorFiltro);

      while ($valorDato=$datosConsulta->fetch_row()) {
//        Ciclo que carga la lista
       ?>
          <tr>
            <td style="visibility:hidden">
              <?php echo $valorDato[1];?>
            </td>
              <td>
                <?php echo $valorDato[0];?>
              </td>
              <td>
                <input type="radio" name="radio" id="radio" value="radio"
                onClick='bajar(<?php echo '"'. $valorDato[0].'"';?>, <?php echo '"'. $destino.'"';?>,<?php echo '"'. $valorDato[1].'"';?>,<?php echo '"'. $iddestino.'"';?>);'>
             </td>
          </tr>

          <?php //fin ciclo que carga lista
         }?>

    </tbody>
  </table>


  <p>&nbsp;</p>
</form>
</body>
</html>
