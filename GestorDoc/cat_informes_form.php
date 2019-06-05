<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <?php
  /*
  SECCION PARA OBTENER VALORES NECESARIOS PARA LA MODIFICACION DE REGISTROS
  ========================================================================
  */
  include("Parametros/conexion.php");
  $inserta_Datos=new Consultas();
  $id=0;
  $resultado="";

  /*
      VALIDAR SI EL FORMULARIO FUE LLAMADO PARA LA MODIFICACION O CREACION DE UN REGISTRO
  */
  if(isset($_POST['seleccionado'])){
      $id=$_POST['seleccionado'];
      $campos=array('cat_informe','nota');
      /*
          CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
      */
      $resultado=$inserta_Datos->consultarDatos($campos,'cat_informes',"","id",$id );
      $resultado=$resultado->fetch_array(MYSQLI_NUM);
      /*
          CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
      */
      $camposIdForm=array('cat_informe,nota');
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
                  //campo=document.getElementById("frame-trabajo").contentWindow.document.getElementById(camposform[i]);
                  if((campo.tagName=="INPUT")||(campo.tagName=="TEXTAREA")){
                      campo.value=valores[i];
                  }
              }
          }
      </script>

</head>
<body style="background-color:white">

  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="CAT_INFORME" method="POST" onsubmit="return verificar()" style="margin:0px" >

<!-- Campo oculto para controlar EDICION DEL REGISTRO -->
  <input type="hidden" name="idformulario" id="idformulario" value=<?php echo $id;?> >

  <input name="cat_informe" id ="cat_informe" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:97px;z-index:2">
  <textarea name="nota" id="nota" style="position:absolute;left:134px;top:137px;width:379px;height:97px;z-index:3"></textarea>

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:275px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "location='cat_informes_panel.php';" style="position:absolute;left:131px;top:273px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->
<div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:224px; height:22px; z-index:1">
<div class="wpmd">
<div><font color="#808080" class="ws12"><B>Categoria de informes</B></font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:97px; width:70px;; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Categoria :</font></div>
</div></div>

<div id="text3" style="position:absolute; overflow:hidden; left:23px; top:135px; width:70px;; height:23px; z-index:5">
<div class="wpmd">
<div><font color="#333333" class="ws11">Comentarios:</font></div>
</div></div>

  <!-- Fin titulos y etiquetas -->

</body>

<?php

    if(($id!=0 )){
        /*
            CONVERTIR LOS ARRAY A UN STRING PARA PODER ENVIAR POR PARAMETRO A LA FUNCION JS
        */
        $valores=implode(",",$resultado);
        $camposIdForm=implode(",",$camposIdForm);
        //LLAMADA A LA FUNCION JS
        echo '<script>cargarCampos("'.$camposIdForm.'","'.$valores.'")</script>';
    }

if(isset($_POST['cat_informe'])){

    //======================================================================================
    // NUEVO REGISTRO
    //======================================================================================
    $categoria =trim($_POST['cat_informe']);
    $obs       =trim($_POST['nota']);
    $creador   ='usuarioLogin';
    $campos = array( 'cat_informe','creador','nota' );
    $valores="'".$categoria."','".$creador."','".$obs."'";
    $idForm=$_POST['idformulario'];

    if(isset($idForm)&&($idForm!=0)){
      // Si el acceso al form fue para una modificacion
            $inserta_Datos->modificarDato('cat_informes',$campos,$valores,'id',$idForm);
        }else{
      // Si el acceso para el form fue para agregar un nuevo registro.
            $inserta_Datos->insertarDato('cat_informes',$campos,$valores);
        }

}
?>
<script type="text/javascript">


//======================================================================
// FUNCION QUE VALIDA EL FORMULARIO Y LUEGO ENVIA LOS DATOS A GRABACION
//======================================================================
	function verificar()
	{

		if( (document.getElementById('cat_informe').value !='')  ){
		      return true ;

		}	else{
       popup('A','Es necesario ingresar la descipcion de la categoria..!') ;
       return false ;

		}

	}
  </script>

</html>
