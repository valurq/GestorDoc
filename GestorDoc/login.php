<!DOCTYPE HTML>
<html>
<head>

    <title>SGD-Valurq</title>

    <meta charset="utf-8">
    <meta name="generator" content="Web Page Maker">
    <style type="text/css">
    /*----------Text Styles----------*/
    .ws6 {font-size: 8px;}
    .ws7 {font-size: 10px;}
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
    .wpmd {font-size: 13px;font-family: Arial,Sans-Serif;font-style: normal;font-weight: normal;}
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
      <script type="text/javascript" src="Js/funciones.js"> </script>


</head>
<body>


        <div id="image2" style="position:absolute; overflow:hidden; left:-1px; top:1px; width:1350px; height:640px; z-index:0"><img src="Imagenes/paste124.jpg" alt="" title="" border=0 width=1350 height=640></div>

        <div id="shape1" style="position:absolute; overflow:hidden; opacity:0.6;left:-2px; top:183px; width:1350px; height:228px; z-index:1"><img border=0 width="100%" height="100%" alt="" src="Imagenes/shape435114343.png"></div>

        <div id="roundrect1" style="position:absolute; overflow:hidden; left:464px; top:190px; width:303px; height:210px; z-index:2"><img border=0 width="100%" height="100%" alt="" src="Imagenes/roundrect435135328.png"></div>

        <div id="text1" style="position:absolute; overflow:hidden; left:543px; top:194px; width:150px; height:25px; z-index:3">
        <div class="wpmd">
        <div><font color="#FFFFFF" class="ws14">Inicio de sesión</font></div>
        </div></div>

        <div id="image1" style="position:absolute; overflow:hidden; opacity: 0.85; left:562px; top:31px; width:108px; height:108px; z-index:4"><img src="Imagenes/valurq2.png" alt="" title="" border=0 width=108 height=108></div>

        <div id="text2" style="position:absolute; overflow:hidden; left:13px; top:189px; width:426px; height:49px; z-index:5">
        <div class="wpmd">
        <div><font color="#FFFFFF" class="ws18"><B>Sistema gestor de documentos</B></font></div>
        <div><font color="#000000">Version 1.0 / 2.019</font></div>
        </div></div>

<form name="login" method="POST"  style="margin:0px" >

        <input name="user" id="user" type="text" style="position:absolute;width:200px;left:518px;top:267px;z-index:6">
        <input name="pass" id="pass" type="password" style="position:absolute;width:200px;left:518px;top:322px;z-index:7">

        <div id="text3" style="position:absolute; overflow:hidden; left:518px; top:242px; width:86px; height:25px; z-index:8">
        <div class="wpmd">
        <div><font color="#FFFFFF" class="ws14">Usuario</font></div>
        </div></div>

        <div id="text4" style="position:absolute; overflow:hidden; left:519px; top:300px; width:150px; height:25px; z-index:9">
        <div class="wpmd">
        <div><font color="#FFFFFF" class="ws14">Contraseña</font></div>
        </div></div>

        <input name="INGRESAR" type="button" value="INGRESAR" onclick="valida()"   style="position:absolute;left:568px;top:357px;z-index:10">
        <div id="shape2" style="position:absolute; overflow:hidden; left:471px; top:222px; width:287px; height:2px; z-index:11"><img border=0 width="100%" height="100%" alt="" src="Imagenes/shape435734968.png"></div>

</form>


<div id="text5" style="position:absolute; overflow:hidden; left:13px; top:390px; width:173px; height:15px; z-index:12">
<div class="wpmd">
<div><font color="#FFFFFF" class="ws7">Desarrollado por VALURQ S.R.L.</font></div>
</div></div>

<div id="aviso" name="aviso" style="position:absolute; visibility: hidden; overflow:hidden; left:800px; top:350px; width:400px; height:15px; z-index:12">
  <font color="#FFFFFF" > * USUARIO / CONTRASEÑA INCORRECTO *</font>
</div>

</body>


<script type="text/javascript">

function valida(){
   var vuser=document.getElementById('user').value;
   var vpass=document.getElementById('pass').value;
   var vretorno='' ;

   if((vuser=="")||(vpass=='')) {
       popup('Advertencia',"DEBE INGRESAR USUARIO y CONTRASEÑA");
   }else {
           //metodo,url destino, nombre parametros y valores a enviar, nombre con el que recibe la consulta
           $.post("autentica.php", {user: vuser, pass: vpass }, function(retorno) {
              vretorno=retorno.trim() ;
              //alert(vretorno);
               if(vretorno=="correcto"){
                 window.location='menu_principal.php';
                 //docuent.body.innerHTML=
               } ;

               if(vretorno=="errorUser"){
                   popup('Advertencia',"USUARIO INCORRECTO");

               } ;

               if(vretorno=="errorPass"){
                   popup('Advertencia',"CONTRASEÑA INCORRECTA");
               } ;


            });
   }
}

  </script>

</html>
