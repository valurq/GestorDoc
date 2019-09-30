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
      //echo "  <script type='ext/javascript'> alert(".$_SESSION['message'].") ;  </script>" ;
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>

  <form method="POST" action="adjunta_graba.php" onsubmit="return validacion() " enctype="multipart/form-data">

    <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>

    <div><font color="#808080" class="ws12"><B>INDEXADO DE DOCUMENTO MASIVO</B></font></div>
    <br>
    <div id="upload" style="visibility:visible">
      <!--EVENTO QUE AYUDA A ADJUNTAR ARCHIVO AL SISTEMA, UNO POR UNO -->
      <input type="file" name="uploadedFile" />
    </div>

    <div id="vinculo" style="visibility:hidden;position: absolute;left:200px;top:40px;font-family:arial">
      <!--LINK DE ACCESO A VISUALIZAR EL ARCHIVO YA ADJUNTO O CARGADO AL SISTEMA. -->
      <a id="vinculo_doc" href="#" target="_blank">Ver adjunto</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      Archivo:<input id="nombredoc" name="nombredoc" readonly type="text" style="font-family:arial;font-size:12px;font-weight:bold;border:none">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ID :<?php echo $id;?>
    </div>


<!--
        DATOS BASICOS DEL DOCUMENTO INGRESADO
-->

    <font color="#000000" class="ws12"><B>Datos del documento</B></font>
    <table width="55%" border="0" cellpadding="0" cellspacing="0" style="font-family:arial;font-Size=20px">
      <tr></tr>
        <tr>
              <td width="20%"> Titulo *:</td>
              <td width="35%"><input name="titulo" id="titulo" type="text" placeholder="..algun titulo del documento" style="width:400px;z-index:2"></td>
        </tr>
        <tr>
              <td width="20%">Fecha : </td>
              <td><input name="fecha" id="fecha" type="date" style="width:160px;z-index:2"></td>
        </tr>
        <tr>
              <td width="20%">Numero : </td>
              <td><input name="numero" id="numero" type="text" placeholder="...algun numero en documento" style="width:160px;z-index:2"></td>
        </tr>
        <tr>
              <td width="20%">Referencia *: </td>
              <td><input name="referencia" id="referencia" type="text" placeholder="..referencia corta" style="width:400px;z-index:2"></td>
        </tr>
        <tr>
              <td width="20%">Vencimiento : </td>

              <td><input name="vto" id="vto" type="date" style="width:160px;z-index:2">

                  <div id="notifica" style="width:379px;height:47px;z-index:3">
                    Notificar ?:
                  <?php
                    $inserta_Datos->opciones_sino("notifica_opcion",$notifica_valor) ;
                  ?>
                  ....<input name="dias_antes" id="dias_antes" type="text" style="width:20px;z-index:2">
                  ...dias antes del vto.
                </div>

              </td>


        </tr>
        <tr>
              <td width="20%">Categoria *: </td>
              <td><input name="categoria" id="categoria" type="text" readonly style="width:160px;z-index:2">
                  <input  type="button"  class="botonlista" onclick = "popup_lista('categoria','categoria','categoria','id','idcategoria');" >
                  <input name="idcategoria" id="idcategoria" type="text" style="visibility:hidden; width:50px;z-index:2">
            </td>
        </tr>
        <tr>
              <td width="20%">Mueble *: </td>
              <td><input name="ubicacion" id="ubicacion" type="text" readonly style="width:160px;z-index:2">
                <input  type="button"  class="botonlista" onclick = "popup_lista('ubicacion','ubi_mueble','mueble','id','idubicacion');" >
                  <input name="idubicacion" id="idubicacion" type="text" style="visibility:hidden; width:50px;z-index:2">
            </td>
        </tr>
        <tr>
              <td width="20%">Gaveta *: </td>
              <td><input name="etiqueta" id="etiqueta" type="text" readonly style="width:160px;z-index:2">
                <input  type="button"  class="botonlista" onclick = "popup_listaFiltro('etiqueta','ubi_gabetas','etiqueta','id','ubi_gavetas_id','ubi_mueble_id','idubicacion');" >
                <input name="ubi_gavetas_id" id="ubi_gavetas_id" type="text" style="visibility:hidden; width:50px;z-index:2">
            </td>
        </tr>
        <tr>
              <td width="20%">Observacion : </td>
              <td><textarea name="obs" id="obs" type="textarea" rows="3" cols="10" placeholder="...comentarios varios." style="width:400px;z-index:2"></textarea></td>
        </tr>
        <tr>
              <td width="20%" align="right"><input type="submit" name="uploadBtn"  class="botones" value="Confirmar" /> </td>
              <td align="right"><input name="volver" type="button"  class="botones" value="Volver" onclick = "location='docPendientes_panel.php';" ></td>
        </tr>
    </table>
        <input name="marca" id="marca" type="hidden"  value="indexa">
  </form>

</body>


<?php
/*
    LLAMADA A FUNCION JS CORRESPONDIENTE A CARGAR DATOS EN LOS CAMPOS DEL FORMULARIO HTML
*/
    if(($id!=0 )){
        /*
            CONVERTIR LOS ARRAY A UN STRING PARA PODER ENVIAR POR PARAMETRO A LA FUNCION JS
        */
        $valores=implode(",",$resultado);
        $camposIdForm=implode(",",$camposIdForm);

        //LLAMADA A LA FUNCION JS
        echo '<script>cargarCampos("'.$camposIdForm.'","'.$valores.'")</script>';

// carga adicionalmente los demas datos que solo se tiene el ID
        $resultado_cate=$inserta_Datos->consultarDatos(array('categoria'),'categoria',"","id",$resultado['5'] );
        $resultado_cate=$resultado_cate->fetch_array(MYSQLI_NUM);
        echo '<script>cargarCampos("'."categoria".'","'.$resultado_cate[0].'")</script>';

//      Gaveta descripcion y ID
        $resultado_gaveta=$inserta_Datos->consultarDatos(array('etiqueta','ubi_mueble_id','id'),'ubi_gabetas',"","id",$resultado['6'] );
        $resu_gaveta=$resultado_gaveta->fetch_array(MYSQLI_NUM);
        echo '<script>cargarCampos("'."etiqueta".'","'.$resu_gaveta[0].'")</script>';
        echo '<script>cargarCampos("'."ubi_gavetas_id".'","'.$resu_gaveta[2].'")</script>';

//      mueble descripcion y ID
        $resultado_mueble=$inserta_Datos->consultarDatos(array('mueble','id'),'ubi_mueble',"","id",$resu_gaveta['1'] );
        $resu_mueble=$resultado_mueble->fetch_array(MYSQLI_NUM);
        echo '<script>cargarCampos("'."ubicacion".'","'.$resu_mueble[0].'")</script>';
        echo '<script>cargarCampos("'."idubicacion".'","'.$resu_mueble[1].'")</script>';

// datos de documento para el link de acceso

        $consultaDocumento=$inserta_Datos->consultarDatos(array('path_server','nombre_final'),'documento',"","id",$id );
        $datoDocumento=$consultaDocumento->fetch_array(MYSQLI_NUM);
        $link = ".".$datoDocumento[0]."/".$datoDocumento[1] ;

        echo '<script>document.getElementById("upload").style.visibility="hidden";
                       document.getElementById("vinculo").style.visibility="visible";
                       document.getElementById("vinculo_doc").href="'.$link.'" ;
                       document.getElementById("nombredoc").value="'.$link.'" ;
            </script>';

    }
?>

<script>

function validacion() {
  var retornoValor = true  ;

  if(document.getElementById('titulo').value == ''){
    retornoValor = false ;
  }
  if(document.getElementById('referencia').value == ''){
    retornoValor = false ;
  }
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
