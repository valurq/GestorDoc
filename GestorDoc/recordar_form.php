<!DOCTYPE HTML>
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

        //    PARAMETROS RECIBIDOS
              $id = $_GET['idDocumento'] ;
              $idNota = $_GET['idNota'] ;

        /*
            VALIDAR SI EL FORMULARIO FUE LLAMADO PARA LA MODIFICACION O CREACION DE UN REGISTRO
        */
      //  if(isset($_POST['seleccionado'])){
          //  $id=$_POST['seleccionado'];
            $campos=array('nota','fe_aviso','mail_aviso','ejecutado');
            /*
                CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
            */
            $resultado=$inserta_Datos->consultarDatos($campos,'recordatorios',"","id",$idNota );
            $resultado=$resultado->fetch_array(MYSQLI_NUM);
            $ejecutado=$resultado[3];
            /*
                CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
            */
            $camposIdForm=array('nota','fe_aviso','mail_aviso','ejecutado');
      //  }
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
</head>
<body style="background-color:white">
  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="RECORDATORIO" method="POST" onsubmit="return verificar()" style="margin:0px" >
  <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
  <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>
  <input type="hidden" name="idNota" id='idNota' value=<?php echo $idNota;?>>

<table style="position:absolute;left:16px;top:40px;">
    <tr>
        <td>Nota*:</td>
        <td>
            <textarea rows="3" cols="40" name="nota" id="nota" value="<?php echo $resultado[0];?>" ></textarea>
        </td>
    </tr>

    <tr>
      <td>Fecha de aviso*:</td>
      <td><input type="date" name="fe_aviso" id='fe_aviso' value=<?php echo $resultado[1];?>></td>
    </tr>
    <tr>
        <td>Mail*:</td>
        <td><input type="text" name="mail_aviso" id='mail_aviso' size="38px" value=<?php echo $resultado[2];?>></td>
    </tr>
    <tr>
        <td>Ejecutado:</td>
        <td>  <?php
            $inserta_Datos->opciones_sino("ejecutado",$ejecutado) ;
          ?>
          </td>
    </tr>
</table>

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:195px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "window.close();" style="position:absolute;left:131px;top:195px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->
<div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:224px; height:22px; z-index:1">
<div class="wpmd">
<div><font color="#808080" class="ws12"><B>Notas a recordar</B></font></div>
</div></div>



  <!-- Fin titulos y etiquetas -->

</body>

<?php
/*
    LLAMADA A FUNCION JS CORRESPONDIENTE A CARGAR DATOS EN LOS CAMPOS DEL FORMULARIO HTML
*/
    if(($idNota!=0 )){
        /*
            CONVERTIR LOS ARRAY A UN STRING PARA PODER ENVIAR POR PARAMETRO A LA FUNCION JS
        */
        $valores=implode(",",$resultado);
        $camposIdForm=implode(",",$camposIdForm);
        //LLAMADA A LA FUNCION JS
        echo '<script>cargarCampos("'.$camposIdForm.'","'.$valores.'")</script>';
    }



    //======================================================================================
    // EVALUE  NUEVO REGISTRO / MODIFICACION
    //======================================================================================
    if(isset($_POST['nota'])){
        $nota =trim($_POST['nota']);
        $fe_aviso=$_POST['fe_aviso'] ;
        $mail = $_POST['mail_aviso'] ;
        $ejecutado = $_POST['ejecutado'];


        $idForm=$_POST['Idformulario'];
        $idNota=$_POST['idNota'];
        $creador   = $_SESSION['usuario'] ;

        $campos = array( 'nota','documento_id','creador','fe_aviso','mail_aviso','ejecutado' );
        $valores="'".$nota."','".$idForm."','".$creador."','".$fe_aviso."','".$mail."','".$ejecutado."'";

        /*
            VERIFICAR SI LOS DATOS SON PARA MODIFICAR UN REGISTRO O CARGAR UNO NUEVO
        */

        if(isset($idForm) && ($idForm!=0) && ($idNota==0) ){
          // una NUEVA NOTA
            $inserta_Datos->insertarDato('recordatorios',$campos,$valores);
        }
        if($idNota!=''){
          // modifica NOTA EXISTENTE
            $inserta_Datos->modificarDato('recordatorios',$campos,$valores,'id',$idNota);
        }

       echo "<script>window.close() ;</script>" ;
    }

?>
<script type="text/javascript">


//======================================================================
// FUNCION QUE VALIDA EL FORMULARIO Y LUEGO ENVIA LOS DATOS A GRABACION
//======================================================================
	function verificar(){
		if( (document.getElementById('nota').value !='')  ){
		    return true ;

		}else{
        // Error - Advertencia - Informacion
            popup('Advertencia','Es necesario ingresar datos requeridos') ;
            return false ;
		}
	}
  </script>

</html>
