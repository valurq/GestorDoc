function incluirJQuery(){
    var script=document.createElement('script');
    script.src="JS/jquery-3.4.0.js";
    document.head.appendChild(script);
}
function seleccionarFila(id){
    if(document.getElementById('seleccionado').value!=''){
        var anterior=document.getElementById('seleccionado').value;
        document.getElementById(anterior).style.backgroundColor='white';
    }
    document.getElementById(id).style.backgroundColor='red';
    document.getElementById("seleccionado").value=id;
}
//FUNCION QUE ES LLAMADA POR EL CAMPO DE BUSQUEDA PARA REALIZAR CONSULTAS A LA BASE DE DATOS Y MOSTRAR EN LA TABLA CORRESPONDIENTE
//PARAMETROS : OBJETO (EL INPUT BUSCADOR)   ;  TABLA: TABLA CORRESPONDIENTE A LA BASE DE DATOS DONDE SE REALIZARA LA BUSQUEDA
function buscarTabla(obj,tabla) {
        var id=obj.id;
        var textoBusqueda = $("#"+id).val();
            //metodo,url destino, nombre parametros y valores a enviar, nombre con el que recibe la consulta
            $.post("Parametros/buscador.php", {valor: textoBusqueda ,origen:tabla}, function(mensaje) {
                $("#resultadoBusqueda").html(mensaje);
             });
    }

function eliminar(tabla){
   var sel=document.getElementById('seleccionado').value;
  // alert(sel)
   if((sel=="")||(sel==' ')||(sel==0)){
       popup('A',"DEBE SELECCIONAR UN ELEMENTO PARA PODER ELIMINARLO");
   }else {
           //metodo,url destino, nombre parametros y valores a enviar, nombre con el que recibe la consulta
           $.post("Parametros/eliminador.php", {id : sel , tabla : tabla}, function(msg) {
            //   alert(msg);
               if(msg==1){
                   document.getElementById('seleccionado').value="";
                   location.reload();
               }else{
                   popup('E',"ERROR EN LA ELIMINACION DEL REGISTRO");
               }
            });
   }
}
function editar(pagina){
    document.getElementById("formularioMultiuso").action=pagina;
    document.getElementById("formularioMultiuso").submit();
}
//FUNCION PARA LEVANTAR MENSAJES EN PANTALLA
function popup(simbolo,mensaje){
    if(!(document.getElementById("popup"))){
        crearPopup();
    }
    document.getElementById("imagenPopup").style.backgroundImage=seleccionarImagen(simbolo);
    document.getElementById("mensajePopup").value=mensaje;
    $("#popup")
}
function seleccionarImagen(identificador){
    var devolver;
    switch (identificador) {
        case 'Error':
            devolver="Imagenes/error.png"
            break;
        case 'Advertencia':
            devolver="Imagenes/advertencia.png"
            break;
        case 'Informacion':
            devolver="Imagenes/advertencia.png"
            break;
        default:
            devolver='';
    }
}
function crearPopup(){
    var pop=document.createElement('div');
    pop.id="popup";
    var popImg=document.createElement('div');
    popImg.id="imagenPopup";
    var popMsj=document.createElement('textarea');
    popMsj.id="mensajePopup";
    var popBoton=document.createElement('input');
    popBoton.type='Button';
    popBoton.id="btPopupAceptar"
    popBoton.value='Aceptar';
    popBoton.addEventListener( 'click', cerrarPopup);
    document.body.appendChild(pop);
    document.getElementById('popup').appendChild(popImg);
    document.getElementById('popup').appendChild(popMsj);
    document.getElementById('popup').appendChild(popBoton);
}
function cerrarPopup(){
    document.getElementById('popup').style.display="none";
}/*
function crearPopupConfirmacion(){
    var pop=document.createElement('div');
    pop.id="popupConfirmacion";
    var popImg=document.createElement('div');
    popImg.id="imagenPopup";
    var popMsj=document.createElement('textarea');
    popMsj.id="mensajePopup";
    var popBoton=document.createElement('input');
    popBoton.type='Button';
    popBoton.id="btPopupAceptar"
    popBoton.value='Aceptar';
    popBoton.addEventListener( 'click', aceptarPopup);
    var popBoton=document.createElement('input');
    popBoton.type='Button';
    popBoton.id="btPopupCancelar"
    popBoton.value='Cancelar';
    popBoton.addEventListener( 'click', cerrarPopup);
    document.body.appendChild(pop);
    document.getElementById('popup').appendChild(popImg);
    document.getElementById('popup').appendChild(popMsj);
    document.getElementById('popup').appendChild(popBoton);
}*/
//incluirJQuery();


/*
SECCION VALIDACIONES
*/

function esVacio(objeto){
    var resultado;
    ((objeto.value!="")&&(objeto.value!=" ")&&((objeto.value).strlenght>0))?resultado =true:resultado= false ;
}
function crearMenu(dir,imagen,titulo,permiso){
    var dire=document.createElement("a");
    dire.className="url";
    dire.id="a-"+cont;
    dire.href=dir;
    dire.target="frame-trabajo"
    var item=document.createElement("div");
    item.className="menu-opcion";
    item.id="b-"+cont;
    var icono=document.createElement("div");
    icono.className="icono-opcion";
    icono.id="c-"+cont;
    icono.style.backgroundImage=imagen;
    var titu=document.createElement("div");
    titu.className="titulo-opcion";
    titu.id="d-"+cont;
    titu.innerText=titulo;
    if(permiso=="NO"){
        dire.href="about:blank";
        item.className+=" desactivado";
    }
    dire.appendChild(item);
    item.appendChild(icono);
    item.appendChild(titu);
    document.getElementById('menu-items').appendChild(dire);
    document.getElementById("a-"+cont).appendChild(item);
    document.getElementById("b-"+cont).appendChild(icono);
    document.getElementById("b-"+cont).appendChild(titu);
    cont++;
}
