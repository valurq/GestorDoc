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

          $campos= array('titulo','bus_fecha','bus_numero','bus_texto','fecha_vto','creador',
          'nombre_origen','obs','notificar_diasantes','notificar_vto','categoria_id','fecreacion',
          'path_server','fec_engabeta') ;

          /*
              CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
          */
          $camposIdForm= array('categoria','fecha','numero','texto','vencimiento','creador','nombreoriginal',
                               'obs','dias','notifica','idcategoria','fecCreacion','pathserver','fegabeta') ;

          /*
              CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
          */
          $resultado=$inserta_Datos->consultarDatos($campos,'documento',"","id",$id );
          $resultado=$resultado->fetch_array(MYSQLI_NUM);

/*          DATOS PARA MUEBLES/GABETAS*/
          $camposM=array('ubi_gabetas_id') ;
          $resMueble=$inserta_Datos->consultarDatos($camposM,'documento',"","id",$id );
          $resMueble=$resMueble->fetch_array(MYSQLI_NUM);

          $idGabeta = $resMueble[0] ; //codigo de la Gabeta
          $camposG=array('ubi_mueble_id','etiqueta') ;
          $resGabeta=$inserta_Datos->consultarDatos($camposG,'ubi_gabetas',"","id",$idGabeta );
          $resGabeta=$resGabeta->fetch_array(MYSQLI_NUM);

          $idMueble=$resGabeta[0] ; // codigo de mueble
          $camposMueble=array('mueble') ;
          $resultadoMueble=$inserta_Datos->consultarDatos($camposMueble,'ubi_mueble','','id',$idMueble );
          $resultadoMueble=$resultadoMueble->fetch_array(MYSQLI_NUM);

/*          DATO PARA DESCRIPCION DE CATEGORIA*/
          $campos_2=array('categoria') ;
          $resultado_2=$inserta_Datos->consultarDatos($campos_2,'categoria',"","id",$resultado[10] );
          $resultado_2=$resultado_2->fetch_array(MYSQLI_NUM);
          $dsc_categoria= $resultado_2[0];

      }
  ?>

  <title>VALURQ SRL</title>


  <style type="text/css">

        /* estilo para pestañas en documentos y sus datos */
        .tab {
          overflow: hidden;
          border: 1px solid #ccc;
          background-color: #f1f1f1;
          width: 900px;
          position:absolute;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
          background-color: inherit;
          float: left;
          border: none;
          outline: none;
          cursor: pointer;
          padding: 14px 16px;
          transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
          background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
          background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
          display: none;
          padding: 6px 12px;
          border: 1px solid #ccc;
          border-top: none;
        }
        .tablaNormal{
          background-color: #FFFFFF ;
        }
        .tablaNormal > tr {
          background-color: #FFFFFF ;
        }
  </style>

  <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
  <link rel="stylesheet" href="CSS/popup.css">
  <link rel="stylesheet" href="CSS/paneles.css">
  <script type="text/javascript" src="Js/funciones.js"></script>

  <script
    src="https://code.jquery.com/jquery-3.4.0.js"
    integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
    crossorigin="anonymous">
  </script>

  <script>


  function NuevoPopup(id,formularioPHP){
      /*
      Funcion : genera una ventana HTML para ingreso de datosPanel

      Parametros
      --------------
      id : id del documento para grabar el dato

      */
        var idnota=document.getElementById('seleccionado').value;
        var url = "../GestorDoc/"+formularioPHP+"?idDocumento="+id+"&idNota="+idnota ;
        var configuracion = "width=600,height=300, toolbar=no,titlebar=yes,resizable=0,menubar=no,location=0,directories=no,status=no" ;
        var myWindow = window.open(url,"Asignacion de dato adicional", configuracion);
  }


    function verPropiedades(){
      var x = document.getElementById('display') ;
      if(  x.style.height=='250px' ){
          x.style.height='600px' ;
      }else{
          x.style.height='250px';
      }
    }

    function verPestana(evt, cityName) {
      // Declaracion de variables
      var i, tabcontent, tablinks;

      // Obtener todos los elementos con la clase="tabcontent" y oculatr
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }

      //Obtener todos los elementos con la clase="tablinks" y remover la clase "Active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace("active", "");
      }

      // mostrar la pestaña actual, y agregar clase "active" al boton que abre la pestaña
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
  </script>


</head>

<body>


  <form method="POST" action="adjunta_graba.php" onsubmit="return validacion() "  enctype="multipart/form-data">

    <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>

    <div><font color="#808080" class="ws12"><B>VISUALIZACION DE DOCUMENTOS</B></font></div>



<!--
        DATOS BASICOS DEL DOCUMENTO INGRESADO
-->

    <table width="80%" border="0" cellpadding="0" cellspacing="0" style="font-family:arial;font-Size=20px">
        <tr style="background-color:#ffffff">
              <td width="8%"> Titulo *:</td>
              <td width="15%"><input name="titulo" id="titulo" type="text" readonly style="width:400px;z-index:2"> </td>
            <td>
                ..Id :<input name="idDocumento" id="idDocumento" type="text" value="<?php echo $id;?>" readonly style="width:20px;z-index:2; border:0px">
            </td>
            <td>
              Archivo:<input id="nombredoc" name="nombredoc" readonly type="text" style="font-family:arial;font-size:12px;font-weight:bold;border:none">
            </td>
        </tr>

        <tr style="background-color:#ffffff">
          <td></td>
          <td align="left"></td>
          <td><input name="propiedades" type="button"  class="botones" value="Propiedades" onclick = "verPropiedades();" ></td>
          <td align="rigth"><input name="volver" type="button"  class="botones" value="Volver" onclick = "location='doc_panel.php';" ></td>
        </tr>

    </table>
    <!-- IFRAME QUE CONTIENE LA IMAGEN DEL DOCUMENTO -->
     <iframe   src=""  id="display" name="display"  scrolling="yes" frameborder="1"   style="margin:0px;padding:0px;width:80%;border-width:0px;height:600px"></iframe>
  </form>

<!-- ESQUEMA DE PESTAÑAS-->
<div id="datosTablas" style="position:absolute; visibility:visible;width: 500px;background-color: #ffffff">
  <div id="datos"  class="tab">
    <button class="tablinks" onclick="verPestana(event, 'General')">General</button>
    <button class="tablinks" onclick="verPestana(event, 'Notas')">Notas</button>
    <button class="tablinks" onclick="verPestana(event, 'Recordatorios')">Recordatorios</button>
    <button class="tablinks" onclick="verPestana(event, 'Ubicacion')">Ubicacion</button>
    <button class="tablinks" onclick="verPestana(event, 'Otros')">Otros..</button>

  </div>

    <!-- Contenidos de las pestañas -->
    <br><br>
    <div id="General" class="tabcontent">
      <table border="1px" width="80%" class="tablaNormal">
      <tr  style="background-color:#ffffff" >
        <td  width="40%">
            <table border="1px" width="90%" style="font-family:arial; font-size:11px">
                <tr style="background-color:#ffffff" >
                  <td style="font-family:arial; font-size:11px; font-weight:bold">Categoria:</td>
                  <td><input name="categoria" id="categoria" type="text" readonly style="width:220px; font-size:11px; border: none; z-index:2">
                      <input name="idcategoria" id="idcategoria" type="hidden" readonly style="width:220px; border: none; z-index:2">
                  </td>
                </tr>
                <tr style="background-color:#8ab4f4" >
                  <td style="font-family:arial; font-size:11px; text-align:center; font-weight:bold">INDICES</td>
                  <td></td>

                </tr>
                <tr style="background-color:#ffffff" >
                  <td>Fecha:</td>
                  <td><input name="fecha" id="fecha" type="text" readonly style="width:220px; border: none; z-index:2"></td>
                </tr>
                <tr style="background-color:#ffffff" >
                  <td>Numero:</td>
                  <td><input name="numero" id="numero" type="text" readonly style="width:220px; border: none; z-index:2"></td>
                </tr>
                <tr style="background-color:#ffffff" >
                  <td>Texto:</td>
                  <td><input name="texto" id="texto" type="text" readonly style="width:220px; border: none; z-index:2"></td>
                </tr>
                <tr style="background-color:#8ab4f4" >
                  <td style="font-family:arial; text-align:center; font-size:11px; font-weight:bold">AVISOS</td>
                  <td></td>
                </tr>
                <tr style="background-color:#ffffff" >
                  <td>F.vencim.:</td>
                  <td><input name="vencimiento" id="vencimiento" type="text" readonly style="width:220px; border: none; z-index:2"></td>
                </tr>
                <tr style="background-color:#ffffff" >
                  <td>Notificar:</td>
                  <td><input name="notifica" id="notifica" type="text" readonly style="width:30px; border: none; z-index:2"></td>
                </tr>
                <tr style="background-color:#ffffff" >
                  <td>Dias antes:</td>
                  <td><input name="dias" id="dias" type="text" readonly style="width:30px; border: none; z-index:2">....dias</td>
                </tr>
                <tr style="background-color:#ffffff" >
                  <td></td>
                  <td></td>
                </tr>

            </table>
        </td>

        <td  width="40%">
          <table border="1px" width="90%" style="font-family:arial; font-size:11px; backgound-color:#ffffff">
              <tr style="background-color:#8ab4f4" >
                <td style="font-family:arial; font-size:11px; text-align:center; font-weight:bold">ORIGENES</td>
                <td></td>
              </tr>
              <tr style="background-color:#ffffff" >
                <td>F.de creacion:</td>
                <td><input name="fecCreacion" id="fecCreacion" type="text" readonly style="width:220px; border: none; z-index:2"></td>

              </tr>
              <tr style="background-color:#ffffff" >
                <td>Creador:</td>
                <td><input name="creador" id="creador" type="text" readonly style="width:220px; border: none; z-index:2"></td>
              </tr>
              <tr style="background-color:#ffffff" >
                <td>Path server:</td>
                <td><input name="pathserver" id="pathserver" type="text" readonly style="width:220px; border: none; z-index:2"></td>
              </tr>
              <tr style="background-color:#ffffff" >
                <td>Nombre original:</td>
                <td><input name="nombreoriginal" id="nombreoriginal" type="text" readonly style="width:220px; border: none; z-index:2"></td>
              </tr>
              <tr style="background-color:#8ab4f4" >
                <td style="font-family:arial; text-align:center; font-size:11px; font-weight:bold">COMENTARIOS</td>
                <td></td>
              </tr>
              <tr style="background-color:#ffffff" >
                <td colspan="3" rowspan="3"><textarea name="obs" id="obs" type="textarea" rows="3" readonly cols="10"  style="width:400px;z-index:2"></textarea></td>
                <td></td>
              </tr>
              <tr style="background-color:#ffffff" >
                <td></td>
                <td></td>
              </tr>
              <tr style="background-color:#ffffff" >
                <td></td>
                <td></td>
              </tr>


          </table>
        </td>
      </tr>
      </table>

    </div>

    <div id="Notas" class="tabcontent" style="width:1030px;background-color: #ffffff">
      <div class="menu-panel">
      <br><br>
      <!--campo buscador en el panel -->

        <div class="wpmd" id="text1" style="position:relative; overflow:hidden; left:10px; top:1px; width:540px; height:22px; z-index:1">
              <font color="#808080" class="ws12"><B>Notas sobre el documento</B></font>
        </div>
        <input type="hidden" name="seleccionado" id="seleccionado" value="0">
            <?php
                $cabecera=['Notas','Fecha','Usuario'];
                $campos=['substr(obs,1,60)','fecreacion','creador'];
             ?>

            <input type="button" class="boton_panel" name="Nuevo" onclick = "NuevoPopup(document.getElementById('idDocumento').value,'notas_form.php');"  value="Nuevo">
            <input type="button" class="boton_panel" name="Editar" value="Editar" onclick="NuevoPopup(document.getElementById('idDocumento').value,'notas_form.php');">
            <input type="button" class="boton_panel" name="Eliminar" value="Eliminar" onclick="eliminar('foro')" >
            <input type="button" class="boton_panel" value="Actualizar" onClick="location.reload()">
        </div>

        <div class="mostrar-tabla" style="max-width:700px;height:150px">
            <?php  $inserta_Datos->crearTabla($cabecera,$campos,'foro','documento_id',$id);?>
        </div>
    </div>

    <div id="Recordatorios" class="tabcontent" style="width:1030px;background-color: #ffffff">
      <div class="menu-panel">
      <br><br>
      <!--campo buscador en el panel -->

            <?php
            // CAMPO SELECCIONADO ESTA EN LA SECCION RECORDATORIO.....
                $cabecera=['Notas','F.de aviso','Creador','Avisado'];
                $campos=['substr(nota,1,50)','fe_aviso','creador','ejecutado'];
             ?>

            <input type="button" class="boton_panel" name="Nuevo" onclick = "NuevoPopup(document.getElementById('idDocumento').value,'recordar_form.php');"  value="Nuevo">
            <input type="button" class="boton_panel" name="Editar" value="Editar" onclick="NuevoPopup(document.getElementById('idDocumento').value,'recordar_form.php');">
            <input type="button" class="boton_panel" name="Eliminar" value="Eliminar" onclick="eliminar('recordatorios')" >
            <input type="button" class="boton_panel" value="Actualizar" onClick="location.reload()">
        </div>

        <div class="mostrar-tabla" style="max-width:700px;height:150px">
            <?php  $inserta_Datos->crearTabla($cabecera,$campos,'recordatorios','documento_id',$id);?>
        </div>
    </div>

    <div id="Ubicacion" class="tabcontent" style="width:1030px;background-color: #ffffff">
        <table style="font-family:arial; font-size:11px">
          <tr style="background-color:#ffffff" >
            <td>Mueble : </td>
            <td><input name="mueble" id="mueble" type="text" readonly style="width:220px; font-size:11px; border: none; z-index:2"></td>
          </tr>
          <tr style="background-color:#ffffff" >
            <td>Gabeta : </td>
            <td><input name="gabeta" id="gabeta" type="text" readonly style="width:220px; font-size:11px; border: none; z-index:2"></td>
          </tr>
          <tr style="background-color:#ffffff" >
            <td>F.en gabeta : </td>
            <td><input name="fegabeta" id="fegabeta" type="text" readonly style="width:220px; font-size:11px; border: none; z-index:2"></td>
          </tr>
        </table>
        <h3 style="font-family:arial; font-size:14px">Historico de ubicaciones anteriores</h3>
        <div class="mostrar-tabla" style="max-width:700px;height:150px">
            <?php
                $cabeceraUbicacion=['Fecha','Usuario','Motivo','Ubic.anterior'];
                $camposUbicacion=['fec_fingabeta','mov_usuario','motivo','(select etiqueta from ubi_gabetas where id=historico_gabeta.idgabeta)'];

                $inserta_Datos->crearTabla($cabeceraUbicacion,$camposUbicacion,'historico_gabeta','documento_id',$id);
              ?>
        </div>
    </div>

    <div id="Otros" class="tabcontent" style="width:1030px;background-color: #ffffff">
      <h3>Otros</h3>
      <p>Mas datos</p>
    </div>
</div>
<!-- FIN Contenidos de las pestañas -->

</body>


<?php
/*
    LLAMADA A FUNCION JS CORRESPONDIENTE A CARGAR DATOS EN LOS CAMPOS DEL FORMULARIO HTML
*/
    if(($id!=0 )){
      // datos de documento para el link de acceso
        $consultaDocumento=$inserta_Datos->consultarDatos(array('path_server','nombre_final'),'documento',"","id",$id );
        $datoDocumento=$consultaDocumento->fetch_array(MYSQLI_NUM);
        $link = substr($datoDocumento[0],1,strlen($datoDocumento[0]))."/".$datoDocumento[1] ;

//      VISUALIZACION DE LA IMAGEN EN EL IFRAME
        $contenidoIframe = substr($datoDocumento[0],1,strlen($datoDocumento[0]))."/".$datoDocumento[1] ;
        echo '<script> document.getElementById("display").src="'.$contenidoIframe.'" ;  </script>';

//      Carga de datos tomados de la base de datos
        echo '<script>   document.getElementById("nombredoc").value="'.$link.'" ;  </script>';
        echo '<script>cargarCampos("'."titulo".'","'.$resultado[0].'")</script>';

        $valores=implode(",",$resultado);
        $camposIdForm=implode(",",$camposIdForm);
        echo '<script>cargarCampos("'.$camposIdForm.'","'.$valores.'")</script>';
        echo '<script>cargarCampos("'.'categoria'.'","'.$dsc_categoria.'")</script>';
        echo '<script>cargarCampos("'.'mueble'.'","'.$resultadoMueble[0].'")</script>';
        echo '<script>cargarCampos("'.'gabeta'.'","'.$resGabeta[1].'")</script>';

        echo '<script>


            </script>';

    }
?>


</html>
