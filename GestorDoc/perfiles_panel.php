<!DOCTYPE html>
<?php
include("Parametros/conexion.php");
$consultas=new Consultas();

// ========================================================================
//Seteo de cabecera y campos en el mismo orden para tomar de la $tabla
// ========================================================================
$cabecera=['*','Opcion de menu'];
$campos=['id','(SELECT titulo_menu FROM menu_opcion WHERE id = acceso.menu_opcion_id) as titulo','habilita'];

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
                  var campos=['id','(SELECT titulo_menu FROM menu_opcion WHERE id = acceso.menu_opcion_id) as titulo','habilita'];
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

            function Recargar(){

              var valor_idperfil = document.getElementById('idperfil').value ;
              var nuevosrc = "iframe_perfiles_panel.php?idperfil="+valor_idperfil ;
              document.getElementById('iFrame').src=nuevosrc ;
            }


            function RevisarCheck(){
              var c=0 ;
              var elegidos = '' ;
              var destino  = ' ;'
              var check_item = '' ;

                if(document.getElementById('idperfil').value==''){
                    popup('Advertencia','Es necesario seleccionar un perfil')  ;
                }else{

                  //Revisa cantidad de input tipo check

                    var x =  document.getElementById('iFrame').contentWindow.document.getElementsByName('check') ;
                    var cantidadCheck=x.length -1 ;

                    while(c<=cantidadCheck){
                  //    check_item = "check_"+c ;
                        if(x[c].checked  ){
                          console.log('id ' +x[c].value ) ;
                          elegidos=elegidos+x[c].value +"--";
                        }
                       c=c+1 ;
                    }

                    // PROCESO EN PHP QUE HACE el seteo de los nuevos valores .
                    perfil_id = document.getElementById('idperfil').value ;
                    window.location.href = 'ProcesoPerfil.php?elegidosid='+elegidos+'&perfilid='+ perfil_id;
                }
            }

            function CheckTodos(){
              var c=0 ;

                if(document.getElementById('idperfil').value==''){
                    popup('Advertencia','Es necesario seleccionar un perfil')  ;
                }else{

                  //Revisa cantidad de input tipo check
                    var x =  document.getElementById('iFrame').contentWindow.document.getElementsByName('check') ;
                    var cantidadCheck=x.length -1 ;

                    while(c<=cantidadCheck){
                        x[c].checked = true ;
                       c=c+1 ;
                    }

                }
            }

            function NoCheckTodos(){
              var c=0 ;

                if(document.getElementById('idperfil').value==''){
                    popup('Advertencia','Es necesario seleccionar un perfil')  ;
                }else{

                  //Revisa cantidad de input tipo check
                    var x =  document.getElementById('iFrame').contentWindow.document.getElementsByName('check') ;
                    var cantidadCheck=x.length -1 ;

                    while(c<=cantidadCheck){
                        x[c].checked = false ;
                       c=c+1 ;
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
                document.getElementById('idperfil').value=0 ;
                document.getElementById('perfiles').value='' ;
                var url = "../GestorDoc/parametros/popup_lista.php?destino="+destino+"&tabla="+tabla+"&valor="+valor+"&idvalor="+idvalor+"&iddestino="+iddestino ;
                var configuracion = "width=500,height=300, toolbar=no,titlebar=yes,resizable=0,menubar=no,location=0,directories=no,status=no" ;
                var myWindow = window.open(url,"Opciones", configuracion);

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


            <div class="wpmd" id="text1" style="position:absolute; overflow:hidden; left:10px; top:45px; width:360px; height:22px; z-index:1">
                  <font color="#808080" class="ws12"><B>CONFIGURACION DE PERFILES DE ACCESO</B></font>
            </div>

            <div style="margin-left:35%; border:1px solid grey; width:350px;padding-left:10px;padding-top:5px;padding-bottom:50px" >

                <span style="font-family:arial;font-weight:bold;font-size:12pt">Seleccione pefil</span><br>

                Perfil: <input name="perfiles" id="perfiles" type="text" onChange="alert('aqui mismo');" value="" readonly style="width:230px;z-index:2">
                  <input  type="button"  class="botonlista" onclick = "popup_lista('perfiles','perfil','perfil','id','idperfil');" >
                  <input name="idperfil" id="idperfil" type="hidden"  style="width:50px;z-index:2"><br>

                  <input type="button" class="boton_panel" name="ver" id="ver"
                  style="visibility:visible; position:absolute; margin-left:15%" onclick = "Recargar();" value="Actualizar">

            </div>

        </div>

        <input type="button" class="boton_panel" name="marcarTodos"
        style="margin-left:7%;left:10px" onclick = "CheckTodos();" value="Marcar todos">

        <input type="button" class="boton_panel" name="NomarcarTodos"
        style="margin-left:0,5%;left:10px" onclick = "NoCheckTodos();" value="Desmarcar todos">

        <input type="button" class="boton_panel" name="aplica"
        style="margin-left:0,5%;left:10px" onclick = "RevisarCheck();" value="Aplicar">

         <iframe   src="iframe_perfiles_panel.php"  id="iFrame" name="panelPerfil"  scrolling="yes" frameborder="1"  id="panelPerfil" style="margin:0px;padding:0px;width:98%;border-width:0px;height:450px"></iframe>


    </body>

</html>
