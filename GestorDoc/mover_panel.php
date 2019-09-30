<!DOCTYPE html>
<?php
session_start() ;
include("Parametros/conexion.php");
include("Parametros/verificarConexion.php");

$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['*','F.Doc.','N.Doc.','Titulo','Categoria','Mueble','Gabeta','F.vto'];
$campos=['id','bus_fecha','bus_numero',
'titulo','(SELECT categoria FROM categoria WHERE id = documento.categoria_id)',
'(SELECT mueble FROM ubi_mueble WHERE id=(SELECT ubi_mueble_id FROM ubi_gabetas WHERE id=documento.ubi_gabetas_id))',
'(SELECT etiqueta FROM ubi_gabetas WHERE id=ubi_gabetas_id)','CONCAT(DAY(fecha_vto),"/",MONTH(fecha_vto),"/",YEAR(fecha_vto)) AS f_vto'  ];

?>
<html lang="en" dir="ltr">

    <head>
          <link rel="stylesheet" href="CSS/popup.css">
          <link rel="stylesheet" href="CSS/paneles.css">
          <link rel="stylesheet" type="text/css" href="CSS/estilos.css">

              <script
        			  src="https://code.jquery.com/jquery-3.4.0.js"
        			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        			  crossorigin="anonymous">
            </script>

              <script type="text/javascript" src="Js/funciones.js"></script>

              <script type="text/javascript">
              // para busqueda en paneles
                  var campos=['id','bus_fecha','bus_numero',
                  'titulo','(SELECT categoria FROM categoria WHERE id = documento.categoria_id)',
                  '(SELECT mueble FROM ubi_mueble WHERE id=(SELECT ubi_mueble_id FROM ubi_gabetas WHERE id=documento.ubi_gabetas_id))',
                  '(SELECT etiqueta FROM ubi_gabetas WHERE id=ubi_gabetas_id)','CONCAT(DAY(fecha_vto),"/",MONTH(fecha_vto),"/",YEAR(fecha_vto)) AS f_vto' ];
              </script>

        <meta charset="utf-8">
        <style media="screen">
            .menu-panel{
                width: 100%
            }
            .mostrar-tabla{
                width: 100%;
            }
        </style>
        <title>VALURQ_SRL</title>

            <script>

            function RevisarCheck(){
              //alert("prueba ") ;
              var c=0 ;
              var elegidos = '' ;
              var destino  = ' ;'
              var check_item = '' ;
              //var checkboxes ;
              //var cantidadCheck=0 ;

                if(document.getElementById('ubi_gavetas_id').value==''){
                    popup('Advertencia','Es necesario seleccionar un destino')  ;
                }else{
                  //Revisa cantidad de input tipo check

                    var checkboxes =  document.getElementsByName("check") ;
                    var cantidadCheck=checkboxes.length -1 ;

                    while(c<=cantidadCheck){
                  //    check_item = "check_"+c ;
                        if(checkboxes[c].checked  ){
                          elegidos=elegidos+checkboxes[c].value +"--";
                        }
                       c=c+1 ;
                    }

                    if(document.getElementById('motivo').value ==''){
                      popup('Advertencia','Es necesario ingresar un motivo')  ;
                    }else{
                        // PROCESO EN PHP QUE HACE EL CAMBIO DE GABETAS.
                        destino = document.getElementById('ubi_gavetas_id').value ;
                        motivo = document.getElementById('motivo').value ;
                        window.location.href = 'ProcesoMover.php?documentosid='+elegidos+'&destino='+ destino+'&motivo='+motivo;
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
                document.getElementById('ubi_gavetas_id').value=0 ;
                document.getElementById('etiqueta').value='' ;
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

    <body style="background-color:white" >
<!--============================================================================= -->
<!--CAMPO OCULTO UTILIZADO PARA LA EDICION -->
<!--============================================================================= -->
        <form id="formularioMultiuso" action="" method="post">
            <input type="hidden" name="seleccionado" id="seleccionado" value="0">
        </form>
<!--============================================================================= -->

        <div class="menu-panel" >
          <br><br>
          <!--campo buscador en el panel -->


            <div class="wpmd" id="text1" style="position:absolute; overflow:hidden; left:10px; top:45px; width:324px; height:22px; z-index:1">
                  <font color="#808080" class="ws12"><B>MOVER DOCUMENTOS</B></font>
            </div>

            <div style="margin-left:35%; border:1px solid grey; width:650px;padding-left:10px;padding-top:5px;padding-bottom:5px" >

                <span style="font-family:arial;font-weight:bold;font-size:12pt">Destino</span><br>

                Mueble: <input name="ubicacion" id="ubicacion" type="text" readonly style="width:160px;z-index:2">
                  <input  type="button"  class="botonlista" onclick = "popup_lista('ubicacion','ubi_mueble','mueble','id','idubicacion');" >
                  <input name="idubicacion" id="idubicacion" type="hidden" style="width:50px;z-index:2"><br>

                Gaveta    :&nbsp;<input name="etiqueta" id="etiqueta" type="text" readonly style="width:160px;z-index:2">
                  <input  type="button"  class="botonlista" onclick = "popup_listaFiltro('etiqueta','ubi_gabetas','etiqueta','id','ubi_gavetas_id','ubi_mueble_id','idubicacion');" >
                  <input name="ubi_gavetas_id" id="ubi_gavetas_id" type="hidden" style="width:50px;z-index:2">
                  &nbsp;&nbsp;&nbsp;&nbsp;
                Motivo
                  <input name="motivo" id="motivo" type="text" style="width:200px;height: 25px;z-index:2">
                  <input type="button" class="boton_panel" name="mueve" onclick = "RevisarCheck();" value="Mover">

            </div>

        </div>

        <div style="margin-left:1%; margin-top:-40px">
             Buscador <br><input type="text" name="buscador" id="buscador" size="40" onkeyup="buscarTablaPanelesCheck(campos, this.value ,'documento','buscarfull')">
        </div>

        <div class="mostrar-tabla">
            <?php  $consultas->crearTablaCheck($cabecera,$campos,'documento','titulo','Sin titulo','distinto');?>
        </div>

    </body>

</html>
