<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
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

</head>
<body>
  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="mueble_form" method="POST" onsubmit="return verificar()" style="margin:0px" >
  <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="idformulario" id="idformulario" value="0" >

  <input name="nombre" id ="nombre" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:100px;z-index:2">
  <textarea name="nota" style="position:absolute;left:134px;top:130px;width:379px;height:97px;z-index:3"></textarea>

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:320px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "location='muebles_panel.php';" style="position:absolute;left:131px;top:320px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->

      <div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:254px; height:22px; z-index:1">
      <div class="wpmd">
      <div><font color="#808080" class="ws12"><B>Definicion de muebles</B></font></div>
      </div></div>

      <div id="text2" style="position:absolute; overflow:hidden; left:24px; top:97px; width:150px; height:23px; z-index:4">
      <div class="wpmd">
      <div><font color="#333333" class="ws11">Nombre *:</font></div>
      </div></div>

      <div id="text2" style="position:absolute; overflow:hidden; left:24px; top:142px; width:150px; height:23px; z-index:4">
      <div class="wpmd">
      <div><font color="#333333" class="ws11">Comentario :</font></div>
      </div></div>


  <!-- Fin titulos y etiquetas -->

</body>

<?php
    include("Parametros/conexion.php");
    $inserta_Datos=new Consultas();

if (isset($_POST['nombre'])  ){
    //======================================================================================
    // NUEVO REGISTRO
    //======================================================================================
    $nombre     =trim($_POST['nombre']);
    $obs        =trim($_POST['nota']);
    $creador    ="UsuarioLogin" ;

    $campos = array( '(mueble','creador','obs)' ) ;
    $valores="'".$nombre."','".$creador."','".$obs."'" ;

    $inserta_Datos->insertarDato('ubi_mueble',$campos,$valores);
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
       popup('A','Es necesario ingresar dato requerido.!') ;
       return false ;

		}

	}
  </script>

</html>
