<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <?php
      /*
      SECCION PARA OBTENER VALORES NECESARIOS PARA LA MODIFICACION DE REGISTROS
      ========================================================================
      */
      include("Parametros/conexion.php");
      include("Parametros/verificarConexion.php");
      $inserta_Datos=new Consultas();
      $id=0;
      $resultado="";

      /*
          VALIDAR SI EL FORMULARIO FUE LLAMADO PARA LA MODIFICACION O CREACION DE UN REGISTRO
      */
      if(isset($_POST['seleccionado'])){
          $id=$_POST['seleccionado'];

          $campos= array('titulo','bus_fecha','bus_numero','bus_texto','fecha_vto','categoria_id',
          'ubi_gabetas_id','obs','notificar_diasantes') ;
          /*
              CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
          */
          $resultado=$inserta_Datos->consultarDatos($campos,'documento',"","id",$id );
          $resultado=$resultado->fetch_array(MYSQLI_NUM);

/*          DATO PARA LA OPCION SI/NO DEL FORMULARIO .....NOTIFICAR */
          $campos_2=array('notificar_vto') ;
          $resultado_2=$inserta_Datos->consultarDatos($campos_2,'documento',"","id",$id );
          $resultado_2=$resultado_2->fetch_array(MYSQLI_NUM);
          $notifica_valor= $resultado_2[0];

          /*
              CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
          */
          $camposIdForm= array('titulo','fecha','numero','referencia','vto','idcategoria',
          'etiqueta','obs','dias_antes') ;
      }
  ?>

  <title>VALURQ SRL</title>
  <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
  <link rel="stylesheet" href="CSS/popup.css">
  <script type="text/javascript" src="Js/funciones.js"></script>


    <script>

    function popup_lista(destino,tabla,valor,idvalor,iddestino)
    {
      /*
      Funcion : genera una ventana HTML con las opciones de seleccionables,de una tablita de parametros,
                para cargar un campo del forms
      Parametros
      --------------
      destino : campo del form donde se carga la opcion seleccionada.-
      tabla : tabla del cual se toman los valores para que el usuario lo seleccione.
      valor : dato de la tabla que se muestra al usuario.
      idvalor : identificador del valores
      iddestino : campo del form para cargar el id del valor.-
      */
        var url = "../GestorDoc/parametros/popup_lista.php?destino="+destino+"&tabla="+tabla+"&valor="+valor+"&idvalor="+idvalor+"&iddestino="+iddestino ;
        var configuracion = "width=500,height=300, toolbar=no,titlebar=yes,resizable=0,menubar=no,location=0,directories=no,status=no" ;
        var myWindow = window.open(url,"Opciones", configuracion);
    }

    function popup_listaFiltro(destino,tabla,valor,idvalor,iddestino,campoFiltro,valorFiltro){
      /*
      Funcion : genera una ventana HTML con las opciones de seleccionables,de una tablita de parametros,
                previamente filtrada por una clave/valor tomada del formulario.
      Parametros
      --------------
      destino : campo del form donde se carga la opcion seleccionada.-
      tabla : tabla del cual se toman los valores para que el usuario lo seleccione.
      valor : dato de la tabla que se muestra al usuario...select
      idvalor : identificador del valores...select
      iddestino : campo del form para cargar el id del valor.-
      campoFiltro : campo de la tabla para filtrar las opciones....where
      valorFiltro : valor para el filtro....where
      */

      if( document.getElementById(valorFiltro).value=='') {
        popup('Advertencia','Se requiere seleccionar dato previamente / valorFiltro')  ;

      } else{

      var valorfiltroform = document.getElementById(valorFiltro).value ;
      var url = "../GestorDoc/parametros/popup_lista.php?destino="+destino+"&tabla="+tabla+
      "&valor="+valor+"&idvalor="+idvalor+"&iddestino="+iddestino+"&campoFiltro="+campoFiltro+"&valorFiltro="+valorfiltroform ;

      var configuracion = "width=500,height=300, toolbar=no,titlebar=yes,resizable=0,menubar=no,location=0,directories=no,status=no" ;
      var myWindow = window.open(url,"Opciones", configuracion);

      }
    }

  </script>

</head>

<body>
  <?php
    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>

  <form method="POST" action="adjuntaMasivo_graba.php" onsubmit="return validacion() " enctype="multipart/form-data">

    <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>

    <div><font color="#808080" class="ws12"><B>INGRESO DE DOCUMENTOS EN FORMA MASIVA</B></font></div>
    <br>
    <div id="upload" style="visibility:visible">
      <!--EVENTO QUE AYUDA A ADJUNTAR ARCHIVO AL SISTEMA, UNO POR UNO -->
      <input type="file" name="img[]" multiple>
<!--      <input type="submit" value="Subir"><br><br>  -->
    </div>

<!--
        DATOS BASICOS DEL DOCUMENTO INGRESADO
-->
    <br>
    <font color="#000000" class="ws12"><B>Datos requeridos</B></font>
    <table width="55%" border="0" cellpadding="0" cellspacing="0" style="font-family:arial;font-Size=20px">
      <tr></tr>

        <tr>
              <td width="20%">Categoria *: </td>
              <td><input name="categoria" id="categoria" type="text" readonly style="width:160px;z-index:2">
                  <input  type="button"  class="botonlista" onclick = "popup_lista('categoria','categoria','categoria','id','idcategoria');" >
                  <input name="idcategoria" id="idcategoria" type="hidden" style="width:50px;z-index:2">
            </td>

            <td>Propietario:
              <input name="propie" id="propie" type="text" readonly style="width:160px;z-index:2">
                  <input  type="button"  class="botonlista" onclick = "popup_lista('categoria','categoria','categoria','id','idcategoria');" >
                  <input name="idpropie" id="idpropie" type="hidden" style="width:50px;z-index:2">
            </td>

        </tr>
        <tr>
              <td width="20%">Mueble *: </td>
              <td><input name="ubicacion" id="ubicacion" type="text" readonly style="width:160px;z-index:2">
                <input  type="button"  class="botonlista" onclick = "popup_lista('ubicacion','ubi_mueble','mueble','id','idubicacion');" >
                  <input name="idubicacion" id="idubicacion" type="hidden" style="width:50px;z-index:2">
            </td>
        </tr>
        <tr>
              <td width="20%">Gaveta *: </td>
              <td><input name="etiqueta" id="etiqueta" type="text" readonly style="width:160px;z-index:2">
                <input  type="button"  class="botonlista" onclick = "popup_listaFiltro('etiqueta','ubi_gabetas','etiqueta','id','ubi_gavetas_id','ubi_mueble_id','idubicacion');" >
                <input name="ubi_gavetas_id" id="ubi_gavetas_id" type="hidden" style="visibility:hidden; width:50px;z-index:2">
            </td>
        </tr>

        <tr>
              <td width="20%" align="right"><input type="submit" name="uploadBtn"  class="botones" value="Confirmar" /> </td>
              <td align="right"><input name="volver" type="button"  class="botones" value="Volver" onclick = "location='doc_panel.php';" ></td>
        </tr>
    </table>
    <br><br>
<iframe src="docPendientes_panel.php" name="doc_pendientes"  scrolling="yes"   frameborder="1"  id="doc_pendientes" style="margin:0px;padding:0px;width:98%;border-width:0px;height:450px"></iframe>


  </form>

</body>



<script>

function validacion() {
  var retornoValor = true  ;

  if(document.getElementById('categoria').value == ''){
    retornoValor = false ;
  }
  if(document.getElementById('ubicacion').value == ''){
    retornoValor = false ;
  }
  if(document.getElementById('etiqueta').value == ''){
    retornoValor = false ;
  }

  if(retornoValor==true){
    return retornoValor ;
  }else{
    popup('Advertencia','Es necesario ingresar datos requeridos ( * )')  ;
    return retornoValor ;
  }

}

</script>



</html>
