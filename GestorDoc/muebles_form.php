<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <?php
        /*
        SECCION PARA OBTENER VALORES NECESARIOS PARA LA MODIFICACION DE REGISTROS
        ========================================================================
        */
        session_start();
        echo "<script> var usuario='".$_SESSION['usuario']."'</script>";
        include("Parametros/conexion.php");
        $inserta_Datos=new Consultas();
        $id=0;
        $resultado="";

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
    .wpmd {font-size: 13px;font-family: Arial,Helvetica,Sans-Serif;font-style: normal;font-weight:normal;
    }
      /*----------Para Styles----------*/
    DIV,UL,OL /* Left */{
       margin-top: 0px;
       margin-bottom: 0px;
    }
    #contenedorSubGavetas{
          position: absolute;
          margin-top: 250px;
          margin-left: 134px;
    }
    .titulo-tablaN{
            background-color: #668cff;
            font-family: Arial;
            font-size: 15px;
            font-style: normal;
            font-weight: bold;
            border-top: 1px solid black;
            border-bottom:  1px solid black;
    }
    .cuerpo-tablaN{
            background-color:#f0d657;
    }
    .cuerpo-tablaN>tr:nth-child(odd) {
        background-color:#d3d6da;
    }
    .cuerpo-tablaN>tr:nth-child(even) {
        background-color:#ffffff;
    }
    .cuerpo-tablaN>tr:hover {
      /*Color de fondo al pasar el mouse sobre cada linea
      de la tabla en panels*/
      background-color: #4b85ba;
    }
    .contenedor-tabla{
        height:200px;
        overflow-y:auto;
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
                    //console.log(camposform[i]+" ->"+valores[i]);
                    if((campo.tagName=="INPUT")||(campo.tagName=="TEXTAREA")){
                        campo.value=valores[i];
                    }
                }
            }
        </script>

</head>
<body style="background-color:white" >
  <!-- DISEÑO DEL FORMULARIO, CAMPOS -->
<form name="mueble_form" method="POST" onsubmit="return verificar()" style="margin:0px" >

    <!-- Campo oculto para controlar EDICION DEL REGISTRO -->
    <input type="hidden" name="Idformulario" id='idFormulario' value=<?php echo $id;?>>

  <input name="nombre" id ="nombre" type="text" maxlength=80 style="position:absolute;width:200px;left:133px;top:100px;z-index:2">
  <textarea name="nota" id="nota" style="position:absolute;left:134px;top:130px;width:379px;height:97px;z-index:3"></textarea>
  <div id="contenedorSubGavetas" >
    <h4>Gavetas del mueble</h4>
    <input type="hidden" id='nroFila' name="nroFila" value="">
    <input type="hidden" id='idvalor' name="idvalor" value="">
    <input type="text" name="nombre" id="nombreNuevo" placeholder=" Nombre gaveta">
    <input type="text" name="obs" id="obsNuevo" placeholder=" Observacion gaveta">
    <input type="button" id="nueva" value='Grabar' onclick="cargarTablaNuevo()">
    <input type="button" id="nueva" value='Eliminar'>
    <div class="contenedor-tabla" >
        <table width="100%" cellspacing='0' style="margin-top:10px;">
            <thead class='titulo-tablaN'>
                <tr><td>Nombre Gaveta</td> <td> Observacion</td> </tr>
            </thead>
            <tbody id="tablaGavetas" class='cuerpo-tablaN' >

            </tbody>
        </table>
    </div>
  </div>
  <!-- BOTONES -->
  <input name="guardar" type="button" value="Guardar" onclick="guardarDatos()" style="position:absolute;left:439px;top:530px;z-index:6">
  <input name="volver" type="button" value="Volver" onclick = "location='muebles_panel.php';" style="position:absolute;left:131px;top:530px;z-index:7">
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

      <div id="text2" style="position:absolute; overflow:hidden; left:24px; top:142px; width:100px;; height:23px; z-index:4">
      <div class="wpmd">
      <div><font color="#333333" class="ws11">Comentario :</font></div>
      </div></div>


  <!-- Fin titulos y etiquetas -->

</body>
<script>
    var tabla=new Array();
    var res=false;
    function cargarGavetas(){
        var id ="",campoC="";
        var camposD=['id','etiqueta','obs'];
        if($("#idFormulario").val()!=""){
            id=$("#idFormulario").val();
            camposC='ubi_mueble_id';
        }
        console.log("id"+id+" camposD:"+camposC);
        $.post("Parametros/obtenerDatos.php",{campos:camposD,tabla:"ubi_gabetas",campoCondicion:camposC,valores:id}, function(resultado) {
            //console.log(resultado);
            var res=JSON.parse(resultado);
            for(var i=0;i<res.length;i++){
                cargarTabla(res[i],1);
            }
         });
    }
    function cargarTabla(datos,sql){
        var pos=$("#nroFila").val();
        if(pos==""){
            tabla.push(datos);
            var row=document.createElement('tr');
            row.className='test';
            if(sql==1){
                row.data='cargado'
            }
            row.addEventListener("click",function(){ cargarCamposGaveta(this)});
            var hidden=document.createElement("input");
            hidden.type='hidden';

            var colum1=document.createElement('td');
            colum1.innerHTML=datos[1];
            var colum2=document.createElement('td');
            colum2.innerHTML=datos[2];
            document.getElementById('tablaGavetas').appendChild(row);
            row.appendChild(colum1);
            row.appendChild(colum2);
        }else{
            tabla[pos][0]=datos[0];
            tabla[pos][1]=datos[1];
            tabla[pos][2]=datos[2];
            document.getElementById('tablaGavetas').rows[pos].cells[0].innerHTML=datos[1]
            document.getElementById('tablaGavetas').rows[pos].cells[1].innerHTML=datos[2]
            $("#nroFila").val("");
            $("#idvalor").val("");
            $("#nombreNuevo").val("");
            $("#obsNuevo").val("");
        }

    }
    function cargarTablaNuevo(){
        var datos=[
            $("#idvalor").val(),
            $("#nombreNuevo").val(),
            $("#obsNuevo").val()
        ]
        cargarTabla(datos,0);
    }
    function cargarCamposGaveta(fila){
        var pos=fila.rowIndex-1;
        console.log(fila+"   --  "+pos);
        $("#nroFila").val(pos)
        $("#idvalor").val(tabla[pos][0])
        $("#nombreNuevo").val(tabla[pos][1]);
        $("#obsNuevo").val(tabla[pos][2]);
    }
    function insertarDatosTabla(){
        var filas=document.getElementByClassName('test');
        for(var i=0;i<filas.length;i++){
            if(filas[i].data!='cargado'){
                filas[i].childNodes[0];
                filas[i].childNodes[1];
            }
        }
    }
    cargarGavetas();
    function guardarDatos(){
        var camposCabecera=[ 'mueble','creador','obs' ];
        var datosCabecera=[
            $('#nombre').val(),
            usuario,
            $('#nota').val()
        ];
        var campoCons=['id'];
        if($('#idFormulario').val()=="0"){
            insertar('ubi_mueble',camposCabecera,datosCabecera);
            //obtenerDatos('id','ubi_mueble',camposCabecera,datosCabecera);
            $.post("Parametros/obtenerDatos.php",{campos:campoCons,tabla:'ubi_mueble',campoCondicion:camposCabecera,valores:datosCabecera}, function(resultado) {
                console.log(resultado+" prueba");
                var res=JSON.parse(resultado);
                $('#idFormulario').val(res[0]);
             });
        }else{
            //modificar('ubi_mueble',camposCabecera,datosCabecera,'id',$('#idFormulario').val());
            res=1;

        }
        if(res==true){
            setTimeout(detalleCarga,1000);
        }
    }
    function detalleCarga(){
        var camposDetalle=['ubi_mueble_id','etiqueta','obs'];
        for (var filaReal of tabla) {
            var filas=filaReal.slice();
            console.log(filas);
            if(filas[0]==""){
                filas.shift();
                datosDetalle=[$('#idFormulario').val(),...filas]
                console.log('ubi_gabetas  \ncampos :'+camposDetalle+"\n datos :"+datosDetalle);
                insertar('ubi_gabetas',camposDetalle,datosDetalle);
            }else{
                var id=filas[0];
                filas.shift();
                datosDetalle=[$('#idFormulario').val(),...filas]
                modificar('ubi_gabetas',camposDetalle,datosDetalle,'id',filaReal[0]);
            }
        }
    }
    /*
    if(isset($idForm)&&($idForm!=0)){
        $inserta_Datos->modificarDato('ubi_mueble',$campos,$valores,'id',$idForm);
    }else{
        $inserta_Datos->insertarDato('ubi_mueble',$campos,$valores);
      }
    */
    function insertar(tabla,campos,valores){
        $.ajaxSetup({async:false});
        $.post("Parametros/insertarDatos.php",{campos:campos,tabla:tabla,valores:valores}, function(resultado) {
            console.log(resultado);
            res=resultado;
         });
        $.ajaxSetup({async:true});
    }
    function modificar(tabla,campos,valores,campoIdentificador,valorIdentificador){
        console.log("ingreso a la funcion \n tabla:"+tabla+" \ncampos:"+campos+"\nvalores:"+valores+"\n campoIdentificador:"+campoIdentificador+"test");
        var test;
        $.ajaxSetup({async:false});
        $.post("Parametros/modificarDatosQ.php",{campos:campos,tabla:tabla,campoCondicion:campoIdentificador,valorCondicion:valorIdentificador,valores:valores}, function(resultado) {
            console.log(resultado);
            test=resultado;
         });
        $.ajaxSetup({async:true});
        res=test;
    }
    function setGlobal(valor){
        res=valor;
    }
</script>

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

// if (isset($_POST['nombre'])  ){
//     //======================================================================================
//     // NUEVO REGISTRO
//     //======================================================================================
//     $nombre     =trim($_POST['nombre']);
//     $obs        =trim($_POST['nota']);
//     $creador    ="UsuarioLogin" ;
//     $idForm = $_POST['Idformulario'];
//
//
//     $campos = array( 'mueble','creador','obs' ) ;
//     $valores="'".$nombre."','".$creador."','".$obs."'" ;
//         /*
//           VERIFICAR SI LOS DATOS SON PARA MODIFICAR UN REGISTRO O CARGAR UNO NUEVO
//         */
//         if(isset($idForm)&&($idForm!=0)){
//             $inserta_Datos->modificarDato('ubi_mueble',$campos,$valores,'id',$idForm);
//         }else{
//             $inserta_Datos->insertarDato('ubi_mueble',$campos,$valores);
//           }
// }

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
       popup('Advertencia','Es necesario ingresar dato requerido!') ;
       return false ;

		}

	}
  </script>

</html>
