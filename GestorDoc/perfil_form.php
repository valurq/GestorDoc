<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <?php
    session_start() ;
        /*
        SECCION PARA OBTENER VALORES NECESARIOS PARA LA MODIFICACION DE REGISTROS
        ========================================================================
        */
        include("Parametros/conexion.php");
        include("Parametros/verificarConexion.php");

        $inserta_Datos=new Consultas();
        $id=0;
        $resultado="" ;
        $eliminaDoc="" ;
        $modificaDoc="" ;
        /*
            VALIDAR SI EL FORMULARIO FUE LLAMADO PARA LA MODIFICACION O CREACION DE UN REGISTRO
        */
        if(isset($_POST['seleccionado'])){
            $id=$_POST['seleccionado'];
            $campos=array('perfil','comentario','elimina_doc','modifica_doc');
            /*
                CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
            */
            $resultado=$inserta_Datos->consultarDatos($campos,'perfil',"","id",$id );
            $resultado=$resultado->fetch_array(MYSQLI_NUM);
            $eliminaDoc= $resultado[2];
            $modificaDoc= $resultado[3];
            /*
                CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
            */
            $camposIdForm=array('perfil','nota');
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
      <script
			  src="https://code.jquery.com/jquery-3.4.0.js"
			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			  crossorigin="anonymous"></script>
        <script type="text/javascript" src="Js/funciones.js"></script>

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

          </script>

</head>
<body style="background-color:white" >

  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="perfilForm" method="POST" onsubmit="return verificar()" style="margin:0px" >
  <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="idformulario" id="idformulario" value=<?php echo $id;?> >

  <input name="perfil" id ="perfil" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:100px;z-index:2">

  <div id="elimina_doc" style="position:absolute;left:133px;top:130px;width:379px;height:97px;z-index:3">
  <?php
    $inserta_Datos->opciones_sino("elimina",$eliminaDoc) ;
  ?>
  </div>


    <div id="modifica_doc" style="position:absolute;left:133px;top:160px;width:379px;height:97px;z-index:3">
    <?php
      $inserta_Datos->opciones_sino("modifica",$modificaDoc) ;
    ?>
    </div>

  <textarea name="nota" id="nota" style="position:absolute;left:134px;top:190px;width:379px;height:97px;z-index:3"></textarea>

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:330px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "location='perfil_panel.php';" style="position:absolute;left:131px;top:330px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->
<div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:224px; height:22px; z-index:1">
<div class="wpmd">
<div><font color="#808080" class="ws12"><B>Definicion de perfiles</B></font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:100px; width:70px;; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Perfil *:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:130px; width:100px;; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Elimina doc? *:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:160px; width:110px;; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Modifica doc? *:</font></div>
</div></div>

<div id="text3" style="position:absolute; overflow:hidden; left:23px; top:190px; width:100px;; height:23px; z-index:5">
<div class="wpmd">
<div><font color="#333333" class="ws11">Comentarios:</font></div>
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
    */
    $valores=implode(",",$resultado);
    $camposIdForm=implode(",",$camposIdForm);
    //LLAMADA A LA FUNCION JS
    echo '<script>cargarCampos("'.$camposIdForm.'","'.$valores.'")</script>';
}

if(isset( $_POST['perfil'] )) {

    //======================================================================================
    // NUEVO REGISTRO
    //======================================================================================
    $perfil          =trim($_POST['perfil']);
    $elimina_doc     =trim($_POST['elimina']);
    $modifica_doc    =trim($_POST['modifica']);
    $obs             =trim($_POST['nota']);
    $creador         ="UsuarioLogin" ;
    $idForm          = $_POST['idformulario'];

    $campos = array( 'perfil','elimina_doc','modifica_doc','creador','comentario' );
    $valores="'".$perfil."','".$elimina_doc."','".$modifica_doc."','".$creador."','".$obs."'";
  /*
    VERIFICAR SI LOS DATOS SON PARA MODIFICAR UN REGISTRO O CARGAR UNO NUEVO
  */
  if(isset($idForm)&&($idForm!=0)){
      $inserta_Datos->modificarDato('perfil',$campos,$valores,'id',$idForm);

//    obtengo las opciones de menu para setear con el nuevo perfil
      $menuOpcion=$inserta_Datos->consultarDatos(array('id'),'menu_opcion' );
      $menuOpcionTodos=$menuOpcion->fetch_all(MYSQLI_NUM);

//    recorro toda la tabla de menu_opcion y busco si ya existe en la tabla acceso
      foreach ($menuOpcionTodos as $idOpcion) {
          $resultado=$inserta_Datos->conexion->query("select id from acceso where perfil_id='".$idForm."' and menu_opcion_id='".$idOpcion[0]."'" );
          $ver=$resultado->fetch_all(MYSQLI_NUM);

//        Si NO hay la opcion de menu en la tabla acceso, agrego la opcion de menu.-
          $camposAccesos = array('menu_opcion_id','perfil_id','habilita');
          if($ver[0]==''){
              $valoresAccesos = "'".$idOpcion[0]."','".$idForm."','NO'" ;
              $inserta_Datos->insertarDato('acceso',$camposAccesos,$valoresAccesos);
          }
      }


  }else{
      $inserta_Datos->insertarDato('perfil',$campos,$valores);

//    obtengo el nuevo ID del perfil insertado
      $idNuevo=$inserta_Datos->consultarDatos(array('id'),'perfil','order by id DESC limit 1');
      $idNuevo=$idNuevo->fetch_array(MYSQLI_NUM);

//    obtengo las opciones de menu para setear con el nuevo perfil
      $menuOpcion=$inserta_Datos->consultarDatos(array('id'),'menu_opcion' );
      $menuOpcionTodos=$menuOpcion->fetch_all(MYSQLI_NUM);

//    Grabo en tabla acceso el nuevo perfil con todas las opciones disponibles.
      $camposAccesos = array('menu_opcion_id','perfil_id','habilita');
      foreach ($menuOpcionTodos as $idOpcion) {
//        ECHO "opcion :" . $idOpcion[0]."<br>" ;
          $valoresAccesos = "'".$idOpcion[0]."','".$idNuevo[0]."','NO'" ;
          $inserta_Datos->insertarDato('acceso',$camposAccesos,$valoresAccesos);
      }

  }

}
?>
<script type="text/javascript">


//======================================================================
// FUNCION QUE VALIDA EL FORMULARIO Y LUEGO ENVIA LOS DATOS A GRABACION
//======================================================================
	function verificar()
	{

		if( (document.getElementById('perfil').value !='')){
		      return true ;

		}	else{
       popup('Advertencia','Es necesario ingresar el datos requeridos..!') ;
       return false ;

		}

	}
  </script>

</html>
