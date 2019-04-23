function seleccionarFila(id){
    if(document.getElementById('seleccionado').value!=''){
        var anterior=document.getElementById('seleccionado').value;
        document.getElementById(anterior).style.backgroundColor='white';
    }
    document.getElementById(id).style.backgroundColor='red';
    document.getElementById('seleccionado').value=id;
}
//FUNCION QUE ES LLAMADA POR EL CAMPO DE BUSQUEDA PARA REALIZAR CONSULTAS A LA BASE DE DATOS Y MOSTRAR EN LA TABLA CORRESPONDIENTE
//PARAMETROS : OBJETO (EL INPUT BUSCADOR)   ;  TABLA: TABLA CORRESPONDIENTE A LA BASE DE DATOS DONDE SE REALIZARA LA BUSQUEDA
function buscarTabla(obj,tabla) {
        var id=obj.id;
        var textoBusqueda = $("#"+id).val();
            //metodo,url destino, nombre parametros y valores a enviar, nombre con el que recibe la consulta
            $.post("buscador.php", {valor: textoBusqueda ,origen:tabla}, function(mensaje) {
                $("#resultadoBusqueda").html(mensaje);
             });
    }

function eliminar(tabla){
   var sel=document.getElementById('seleccionado').value;
   if((sel=="")||(sel==' ')){
       popup('A',"DEBE SELECCIONAR UN ELEMENTO PARA PODER ELIMINARLO");
   }else {
           //metodo,url destino, nombre parametros y valores a enviar, nombre con el que recibe la consulta
           $.post("../parametros/eliminador.php", {id: sel,origen:tabla}, function(mensaje) {
               if(mensaje==1){
                   location.reload();
               }else{
                   popup('E',"DEBE SELECCIONAR UN ELEMENTO PARA PODER ELIMINARLO");
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
    if(document.getElementById(popup)==null){
        crearPopup();
    }
    document.getElementById("imagenPopup").style.backgroundImage=seleccionarImagen(simbolo);
    document.getElementById("mensajePopup").value=mensaje;
}
function seleccionarImagen(identificador){
    var devolver;
    switch (identificador) {
        case W:
            devolver="Imagenes/warning.png"
            break;
        case A:
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
    var popMsj=document.createElement('div');
    popMsj.id="mensajePopup";
    document.body.appendChild(pop);
    document.getElementById('popup').appendChild(popImg);
    document.getElementById('popup').appendChild(popMsj);
}
