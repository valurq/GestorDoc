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
              $campos=array('nombre','apellido','usuario','cargo','dpto','mail','obs','perfil_id','pass');
              /*
                  CONSULTAR DATOS CON EL ID PASADO DESDE EL PANEL CORRESPONDIENTE
              */
              $resultado=$inserta_Datos->consultarDatos($campos,'usuario',"","id",$id );
              $resultado=$resultado->fetch_array(MYSQLI_NUM);
              $idPerfil=$resultado[7];
              /*
                  CREAR EL VECTOR CON LOS ID CORRESPONDIENTES A CADA CAMPO DEL FORMULARIO HTML DE LA PAGINA
              */
              $camposIdForm=array('nombre,apellido,usuario,cargo,dpto,mail,nota,idperfil,pass');
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
<form name="menu" method="POST" onsubmit="return verificar()" style="margin:0px" >
  <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
  <input type="hidden" name="Idformulario" id='Idformulario' value=<?php echo $id;?>>

  <input name="nombre" id ="nombre" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:90px;z-index:2">
  <input name="apellido" id ="apellido" type="text" maxlength=100 style="position:absolute;width:380px;left:133px;top:115px;z-index:2">
  <input name="usuario" id ="usuario" type="text" maxlength=100 style="position:absolute;width:380px;left:133px;top:140px;z-index:2">
  <input name="cargo" id ="cargo" type="text" maxlength=100 style="position:absolute;width:380px;left:133px;top:165px;z-index:2">
  <input name="dpto" id ="dpto" type="text" maxlength=100 style="position:absolute;width:380px;left:133px;top:190px;z-index:2">
  <input name="mail" id ="mail" type="text" maxlength=100 style="position:absolute;width:380px;left:133px;top:215px;z-index:2">
  <textarea name="nota" id="nota" style="position:absolute;left:134px;top:290px;width:379px;height:97px;z-index:3"></textarea>
  <input type="hidden" name="idperfil" id="idperfil" maxlength=100 >

<div id=lisbox style="position:absolute;left:133px;top:240px;width:379px;height:20px;z-index:3">
<?php
  $listbox=new Consultas();
  $listbox->DesplegableElegido($idPerfil,"perfil","id","perfil","perfil") ;
?>
</div>
<input name="pass" id ="pass" type="password" maxlength=100 style="position:absolute;width:380px;left:133px;top:265px;z-index:2">

  <!-- BOTONES -->
  <input name="guardar" type="submit" value="Guardar" style="position:absolute;left:439px;top:395px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "location='usuario_panel.php';" style="position:absolute;left:131px;top:395px;z-index:7">
</form>

  <!-- Titulos y etiquetas -->
<div id="text1" style="position:absolute; overflow:hidden; left:20px; top:21px; width:254px; height:22px; z-index:1">
<div class="wpmd">
<div><font color="#808080" class="ws12"><B>Definicion de usuarios</B></font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:90px; width:70px; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Nombre *:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:115px; width:70px; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Apellido *:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:24px; top:140px; width:70px; height:23px; z-index:4">
<div class="wpmd">
<div><font color="#333333" class="ws11">Login *:</font></div>
</div></div>

<div class="wpmd" id="text2" style="position:absolute; overflow:hidden; left:24px; top:165px; width:70px; height:23px; z-index:4">
  <font color="#333333" class="ws11">Cargo:</font>
</div>

<div class="wpmd" id="text2" style="position:absolute; overflow:hidden; left:24px; top:190px; width:70px; height:23px; z-index:4">
  <font color="#333333" class="ws11">Dpto:</font>
</div>

<div class="wpmd" id="text2" style="position:absolute; overflow:hidden; left:24px; top:215px; width:70px; height:23px; z-index:4">
  <font color="#333333" class="ws11">Mail:</font>
</div>

<div class="wpmd" id="text2" style="position:absolute; overflow:hidden; left:24px; top:240px; width:70px; height:23px; z-index:4">
  <font color="#333333" class="ws11">Perfil:</font>
</div>

<div id="text3" style="position:absolute; overflow:hidden; left:23px; top:265px; width:100px; height:23px; z-index:5">
<div class="wpmd">
<div><font color="#333333" class="ws11">Contraseña:</font></div>
</div></div>

<div id="text3" style="position:absolute; overflow:hidden; left:23px; top:290px; width:100px; height:23px; z-index:5">
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


if (isset($_POST['usuario'])){


    //======================================================================================
    // NUEVO REGISTRO
    //======================================================================================
    $usuario     =trim($_POST['usuario']);
    $nombre       =trim($_POST['nombre']);
    $apellido     =trim($_POST['apellido']);
    $cargo     =trim($_POST['cargo']);
    $dpto     =trim($_POST['dpto']);
    $obs     =trim($_POST['nota']);
    $mail     =trim($_POST['mail']);
    $perfil_id     =$_POST['perfil'];
    $pass = md5($_POST['pass'] ) ;
    $creador    ="UsuarioLogin" ;
    $idForm = $_POST['Idformulario'];


    $campos = array( 'perfil_id','usuario','nombre','apellido','cargo','dpto','obs','mail','creador','pass' );
    $valores="'".$perfil_id."','".$usuario."','".$nombre."','".$apellido."','".$cargo."','".$dpto."','".$obs."','".$mail."','".$creador."','".$pass."'" ;

    /*    VERIFICAR SI LOS DATOS SON PARA MODIFICAR UN REGISTRO O CARGAR UNO NUEVO     */
      if(isset($idForm)&&($idForm!=0)){
          $inserta_Datos->modificarDato('usuario',$campos,$valores,'id',$idForm);
      }else{
        $inserta_Datos->insertarDato('usuario',$campos,$valores);
      }
}
?>
<script type="text/javascript">


//======================================================================
// FUNCION QUE VALIDA EL FORMULARIO Y LUEGO ENVIA LOS DATOS A GRABACION
//======================================================================
	function verificar()
	{

		if( (document.getElementById('nombre').value !='') && (document.getElementById('apellido').value !='') &&  (document.getElementById('usuario').value !='')  ){
		      return true ;

		}	else{
       popup('Advertencia','Es necesario ingresar los datos requeridos..!') ;
       return false ;

		}

	}
  </script>

</html>
