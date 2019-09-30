<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <?php
  session_start();
        /*
        SECCION PARA OBTENER VALORES NECESARIOS PARA LA MODIFICACION DE REGISTROS
        ========================================================================
        */
        include("Parametros/conexion.php");
        include("Parametros/verificarConexion.php");

        $inserta_Datos=new Consultas();
        $id=0;
        $resultado="";

        $camposProp = array('objeto_id','objeto','tipo','propietario','creador','propietario_id');

        /*
            VALIDAR SI EL FORMULARIO FUE LLAMADO PARA LA MODIFICACION O CREACION DE UN REGISTRO
        */
        if(isset($_POST['seleccionado'])){
            $id=$_POST['seleccionado'];
            $campos=array('mueble','obs');
            /*
                CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
            */
            $resultado=$inserta_Datos->consultarDatos($campos,'ubi_mueble',"","id",$id );
            $resultado=$resultado->fetch_array(MYSQLI_NUM);
            /*
                CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
            */
            $camposIdForm=array('nombre,nota');
        }
    ?>

    <title>VALURQ_SRL</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
    <meta name="generator" content="Web Page Maker">
<style type="text/css">
      /*----------Text Styles----------*/
      .ws6 {font-size: 8px;}
      .ws7 {font-size: 9.3px;}
      .ws8 {font-size: 11px;}
      .ws9 {font-size: 12px;}
      .ws10 {font-size: 13px;}
      .ws11 {font-size: 15px;}
      .ws12 {font-size: 16px;}
      .ws14 {font-size: 19px;}
      .ws16 {font-size: 21px;}
      .ws18 {font-size: 24px;}
      .ws20 {font-size: 27px;}
      .ws22 {font-size: 29px;}
      .ws24 {font-size: 32px;}
      .ws26 {font-size: 35px;}
      .ws28 {font-size: 37px;}
      .ws36 {font-size: 48px;}
      .ws48 {font-size: 64px;}
      .ws72 {font-size: 96px;}
      .wpmd {font-size: 13px;font-family: Arial,Helvetica,Sans-Serif;font-style: normal;font-weight: normal;}
      /*----------Para Styles----------*/
      DIV,UL,OL /* Left */
      {
       margin-top: 0px;
       margin-bottom: 0px;
      }
</style>
      <link rel="stylesheet" href="CSS/popup.css">
      <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
      <script
			  src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script>
        <script type="text/javascript" src="Js/funciones.js">
      </script>

      <script type="text/javascript">
            function cargarCampos(camposform,valores){
                var campo;
                camposform=camposform.split(",");
                valores=valores.split(",");
                for(var i=0;i<camposform.length;i++){
                    campo=document.getElementById(camposform[i]);
                    console.log(camposform[i]+" ->"+valores[i]);
                    if((campo.tagName=="INPUT")||(campo.tagName=="TEXTAREA")){
                        campo.value=valores[i];
                    }
                }
            }

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
        </script>

</head>
<body style="background-color:white" >
  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="mueble_form" method="POST" onsubmit="return verificar()" style="margin:0px" >

    <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>

  <input name="nombre" id ="nombre" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:100px;z-index:2">

  <input name="propietario" id="propietario" type="text" readonly style="position:absolute;width:160px;left:133px;top:130px;z-index:2">
      <input  type="button"  class="botonlista" style="position:absolute;left:300px;top:130px;z-index:2"
       onclick = "popup_lista('propietario','vista_propietarios','dato','id','idpropietario');" >
      <input name="idpropietario" id="idpropietario" type="hidden" style=" width:50px;z-index:2">

  <textarea name="nota" id="nota" style="position:absolute;left:134px;top:160px;width:379px;height:97px;z-index:3"></textarea>

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:320px;z-index:6">
  <input name="volver" type="button"  class="botones" value="Volver" onclick = "location='muebles_panel.php';" style="position:absolute;left:131px;top:320px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->

      <div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:254px; height:22px; z-index:1">
      <div class="wpmd">
      <div><font color="#808080" class="ws12"><B>Definicion de muebles</B></font></div>
      </div></div>

      <div id="text2" style="position:absolute; overflow:hidden; left:24px; top:97px; width:70px;; height:23px; z-index:4">
      <div class="wpmd">
      <div><font color="#333333" class="ws11">Nombre *:</font></div>
      </div></div>

      <div id="text2" style="position:absolute; overflow:hidden; left:24px; top:130px; width:90px;; height:23px; z-index:4">
      <div class="wpmd">
      <div><font color="#333333" class="ws11">Propietario :</font></div>
      </div></div>

      <div id="text2" style="position:absolute; overflow:hidden; left:24px; top:160px; width:100px;; height:23px; z-index:4">
      <div class="wpmd">
      <div><font color="#333333" class="ws11">Comentario :</font></div>
      </div></div>


  <!-- Fin titulos y etiquetas -->

</body>

<?php

/*
LLAMADA A FUNCION JS CORRESPONDIENTE A CARGAR DATOS EN LOS CAMPOS DEL FORMULARIO HTML
*/
if(($id!=0 )){
    /*
        CONVERTIR LOS ARRAY A UN STRING PARA PODER ENVIAR POR PARAMETRO A LA FUNCION JS
        SECTOR DE CODIGO QUE CARGA LOS CAMPOS CON EL REGISTRO CUANDO SE INGRESA EN MODO EDITAR...
    */
    $valores=implode(",",$resultado);
    $camposIdForm=implode(",",$camposIdForm);
    //LLAMADA A LA FUNCION JS
    echo '<script>cargarCampos("'.$camposIdForm.'","'.$valores.'")</script>';

    $dato_propietario=$inserta_Datos->consultarDatos($camposProp,'propietarios','','objeto_id',$id);
    $dato_propietario=$dato_propietario->fetch_array(MYSQLI_NUM);
    $dsc_propietario = $dato_propietario[3] ;
    $id_propietario = $dato_propietario[5] ;
    $valoresPropietarios = $dsc_propietario.",'".$id_propietario."'" ;
    $camposPropietarios = 'propietario,id_propietario';
    echo '<script>cargarCampos("'.$camposPropietarios.'","'.$valoresPropietarios.'")</script>';
}

if (isset($_POST['nombre'])  ){
    //======================================================================================
    // NUEVO REGISTRO
    //======================================================================================
    $nombre     =trim($_POST['nombre']);
    $obs        =trim($_POST['nota']);
    $creador    =$_SESSION['usuario'] ;
    $idForm = $_POST['Idformulario'];

    $propietario = trim($_POST['propietario']);
    $idpropieatario = $_POST['idpropietario'] ;
    $verTipo = substr($propietario, -5);
    if($verTipo=='grupo'){
      $tipo="grupo" ;
    }else{
      $tipo="usuario" ;
    }


    $campos = array( 'mueble','creador','obs' ) ;
    $valores="'".$nombre."','".$creador."','".$obs."'" ;
    $valoresProp = "'".$idForm."','mueble','".$tipo."','".$propietario."','".$creador."','".$idpropieatario."'" ;

        /*
          VERIFICAR SI LOS DATOS SON PARA MODIFICAR UN REGISTRO O CARGAR UNO NUEVO
        */
        if(isset($idForm)&&($idForm!=0)){
            $inserta_Datos->modificarDato('ubi_mueble',$campos,$valores,'id',$idForm);

            // propietario
            $objetoId=$inserta_Datos->consultarDatos(array('objeto_id'),'propietarios',"",'objeto_id',$idForm);
            $objetoId=$objetoId->fetch_array(MYSQLI_NUM);
            if( $objetoId[0]!=''){
              // si existe modifica
              $inserta_Datos->modificarDato('propietarios',$camposProp,$valoresProp,'objeto_id',$idForm);
            }else{
                  //no existe, agrega NUEVO
                  $valoresProp = "'".$idForm."','mueble','".$tipo."','".$propietario."','".$creador."','".$idpropieatario."'" ;
                  // Propietario
                  $inserta_Datos->insertarDato('propietarios',$camposProp,$valoresProp);
                }

        }else{
            $inserta_Datos->insertarDato('ubi_mueble',$campos,$valores);

            $ultmoID=$inserta_Datos->consultarDatos(array('id'),'ubi_mueble',"ORDER BY id desc limit 1");
            $ultmoID=$ultmoID->fetch_array(MYSQLI_NUM);
            $idForm = $ultmoID[0] ;
            $valoresProp = "'".$idForm."','mueble','".$tipo."','".$propietario."','".$creador."','".$idpropieatario."'" ;

            // Propietario
            $inserta_Datos->insertarDato('propietarios',$camposProp,$valoresProp);
          }

          echo "<script>window.location='muebles_panel.php'</script>" ;
}

?>
<script type="text/javascript">


//======================================================================
// FUNCION QUE VALIDA EL FORMULARIO Y LUEGO ENVIA LOS DATOS A GRABACION
//======================================================================
	function verificar()
	{

		if( (document.getElementById('nombre').value !='')  ){
		      return true ;

		}	else{
       popup('Advertencia','Es necesario ingresar dato requerido.!') ;
       return false ;

		}

	}
  </script>

</html>
