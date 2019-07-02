<?php

  include("Parametros/conexion.php");
  $inserta_Datos=new Consultas();

  $resultado  ="" ;
  $retornoPass="" ;
  $retornoUser="" ;

    //======================================================================================
    // DATOS
    //======================================================================================
    $user     =trim($_POST['user']);
    $pass     =md5($_POST['pass']);
    $respuesta = "" ;

    $campos=array('id','perfil_id','usuario','pass');

    /*        CONSULTAR DATOS CON EL usuario PASADO DESDE EL LOGIN    */

    $resultado=$inserta_Datos->consultarDatos($campos,'usuario',"","usuario",$user );
    $resultado=$resultado->fetch_array(MYSQLI_NUM);
    $retornoPass= $resultado[3] ;
    $retornoUser=$resultado[2] ;

    if($retornoUser==$user){
        if($retornoPass==$pass){
            $respuesta = 'correcto' ;
            session_start();
            session_name('Privado');
            $_SESSION['idUsu']=$resultado[0];
            $_SESSION['usuario']=$resultado[2];
            $_SESSION['perfil']=$resultado[1];
            $_SESSION['pass']=$resultado[3];
        }else{
            $respuesta = 'errorPass' ;

        }
      }else {
            $respuesta = 'errorUser' ;
      }

      echo $respuesta ;
?>
