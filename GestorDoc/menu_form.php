<!DOCTYPE HTML>
<html>
<head>
  <?php
        /*
        SECCION PARA OBTENER VALORES NECESARIOS PARA LA MODIFICACION DE REGISTROS
        ========================================================================
        */
        session_start() ;
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
            $campos=array('titulo_menu','link_acceso','icono','obs','posicion');
            /*
                CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
            */
            $resultado=$inserta_Datos->consultarDatos($campos,'menu_opcion',"","id",$id );
            $resultado=$resultado->fetch_array(MYSQLI_NUM);
            /*
                CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
            */
            $camposIdForm=array('titulo,url,icono,nota,posi');
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
        </script>

</head>


<body style="background-color:white" >
  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="menu" method="POST" onsubmit="return verificar()" style="margin:0px" >

  <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
  <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>

  <input name="titulo" id ="titulo" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:100px;z-index:2">
  <input name="url" id ="url" type="text"  style="position:absolute;width:200px;left:133px;top:130px;z-index:2">
  <input name="icono" id ="icono" type="text"  style="position:absolute;width:200px;left:133px;top:160px;z-index:2">
  <input name="posi" id ="posi" type="text"  style="position:absolute;width:200px;left:133px;top:190px;z-index:2">
  <textarea name="nota" id="nota" style="position:absolute;left:134px;top:220px;width:379px;height:97px;z-index:3"></textarea>

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:325px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "location='menu_panel.php';" style="position:absolute;left:135px;top:325px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->
<div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:254px; height:22px; z-index:1">
<div class="wpmd">
<div><font color="#808080" class="ws12"><B>Definicion de opciones de menu</B></font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:100px; width:70px;; height:23px; z-index:1">
<div class="wpmd">
<div><font color="#333333" class="ws11">Titulo *:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:130px; width:70px;; height:23px; z-index:1">
<div class="wpmd">
<div><font color="#333333" class="ws11">URL:</font></div>
</div></div>


<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:160px; width:70px;; height:23px; z-index:1">
<div class="wpmd">
<div><font color="#333333" class="ws11">Icono:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:190px; width:70px;; height:23px; z-index:1">
<div class="wpmd">
<div><font color="#333333" class="ws11">Posicion *:</font></div>
</div></div>

<div id="text3" style="position:absolute; overflow:hidden; left:23px; top:212px; width:100px;; height:23px; z-index:1">
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

if ( isset($_POST['titulo']) ) {

    //======================================================================================
    // NUEVO REGISTRO
    //======================================================================================
    $titulo     =trim($_POST['titulo']);
    $url        =trim($_POST['url']);
    $icono        =trim($_POST['icono']);
    $posi        =trim($_POST['posi']);
    $obs        =trim($_POST['nota']);
    $creador    = "UsuarioLogin" ;
    $idForm = $_POST['Idformulario'];

    $campos = array( 'titulo_menu','link_acceso','icono','posicion','creador','obs' );
    $valores="'".$titulo."','".$url."','".$icono."','".$posi."','".$creador."','".$obs."'";

    /*
      VERIFICAR SI LOS DATOS SON PARA MODIFICAR UN REGISTRO O CARGAR UNO NUEVO
    */
    if(isset($idForm)&&($idForm!=0)){
        $inserta_Datos->modificarDato('menu_opcion',$campos,$valores,'id',$idForm);
    }else{
      $inserta_Datos->insertarDato('menu_opcion',$campos,$valores);
    }

    echo "<script>window.location='menu_panel.php'</script>" ;
}

?>
<script type="text/javascript">

//======================================================================
// FUNCION QUE VALIDA EL FORMULARIO Y LUEGO ENVIA LOS DATOS A GRABACION
//======================================================================
	function verificar()
	{

		if( (document.getElementById('titulo').value !='') && (document.getElementById('posi').value !='')    ){
		      return true ;

		}	else{
       popup('Advertencia','Es necesario ingresar los datos requeridos..!') ;
       return false ;

		}

	}
  </script>

</html>
