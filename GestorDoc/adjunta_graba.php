<?php
session_start();

include("Parametros/conexion.php") ;
include("Parametros/verificarConexion.php");
$accesoFunciones=new Consultas() ;
$message = '';
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Confirmar' && $_POST['Idformulario'] == '0')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    /*
          PROCESO DE GRABACION PARA DOCUMENTO NUEVO
    */
          $camposConsultar = array('extensiones','prefijo') ;
          $datosParametros = $accesoFunciones->consultarDatos($camposConsultar,'parametros') ;
          $Parametros = $datosParametros->fetch_array(MYSQLI_BOTH);

          $consultaId = $accesoFunciones->consultarDatos(array('id'),'documento','order by id desc limit 1','') ;
          $ultimoID = $consultaId->fetch_array(MYSQLI_BOTH);

          // Se obtiene datos del archivo cargado
          $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
          $fileName   = $_FILES['uploadedFile']['name'];
          $fileSize   = $_FILES['uploadedFile']['size'];
          $fileType   = $_FILES['uploadedFile']['type'];

          // separa extension del archivo
          $fileNameCmps = explode(".", $fileName);
          $fileExtension = strtolower(end($fileNameCmps));

          // Sanea el nombre del archivo
          $secuencia= $ultimoID['id']+1 ;
          $newFileName = $Parametros['prefijo'].$secuencia.".".$fileExtension;
          //$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

          // Verifica si los archivos tienen las extensiones permitidas.
          $permitidos = explode("-",$Parametros['extensiones']) ;
          $extensionesPermitidas = $permitidos ;
          //$extensionesPermitidas = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');

          $titulo     = trim( $_POST['titulo'] ) ;
          $bus_fecha  = trim( $_POST['fecha'] ) ;
          $bus_numero = trim( $_POST['numero'] ) ;
          $notificar_diasantes = trim( $_POST['dias_antes'] ) ;
          $notificar  = trim( $_POST['notifica_opcion'] ) ;
          $bus_texto  = trim( $_POST['referencia'] ) ;
          $vto        = trim( $_POST['vto'] ) ;
          $obs        = trim( $_POST['obs'] ) ;
          $ubi_gabetas_id=trim($_POST['ubi_gavetas_id']);
          $categoriaid  = trim($_POST['idcategoria']);
          $creador    =$_SESSION['usuario'] ;
          $path_server ='/almacen_digital' ;
          $fec_engabeta=date('Y-m-d', time());

          $nombreOrigen = trim($fileName) ;
          $datosUpload= "tmp:".trim($fileTmpPath).
                         " size:".trim($fileSize).
                         " tipo:".trim($fileType);
          $buscarFull = $bus_fecha.$bus_numero.$bus_texto ;

          $campos = array('titulo','bus_fecha','bus_numero','bus_texto','fecha_vto','obs',
          'nombre_origen','buscarfull','datos_upload','ubi_gabetas_id','categoria_id','creador',
          'path_server','nombre_final','fec_engabeta','notificar_diasantes','notificar_vto') ;

          $valores ="'".$titulo."','".$bus_fecha."','".$bus_numero."','".$bus_texto.
                      "','".$vto."','".$obs."','".$nombreOrigen."','".$buscarFull.
                      "','".$datosUpload."','".$ubi_gabetas_id."','".$categoriaid.
                      "','".$creador."','".$path_server."','".$newFileName."','".$fec_engabeta."','".
                      $notificar_diasantes."','".$notificar."'" ;

          if (in_array($fileExtension, $extensionesPermitidas))
          { //Si la extension del archivo esta dentro de la lista permitida
            // Directorio destino del archivo.
            $uploadFileDir = './almacen_digital/';
            $dest_path = $uploadFileDir . $newFileName;
            // aqui carga en al carpeta destino
            if(move_uploaded_file($fileTmpPath, $dest_path))
            {
              $accesoFunciones->insertarDato('documento',$campos,$valores);

              $message ='Archivo exitosamente cargado.';
            }else{$message = 'Ocurrio un error al mover al directorio destino. Por favor verique si el destino esta habilitado para el servidor web.';}
          }else{$message = 'Fallo la carga. Tipo de archivos permitidos: ' . implode(',', $extensionesPermitidas);}
  }else{$message = 'Hubo algun error en la carga del archivo. Por favor verifique el siguiente error.<br>';
        $message .= 'Error:' . $_FILES['uploadedFile']['error'];}
        //echo $message ;

        $_SESSION['message'] = $message;
        header("Location: adjunta_form.php");
}else{

  /*
        PROCESO DE GRABACION PARA DOCUMENTO EXISTENTE - EDICION
  */
            $titulo     = trim( $_POST['titulo'] ) ;
            $bus_fecha  = trim( $_POST['fecha'] ) ;
            $bus_numero = trim( $_POST['numero'] ) ;
            $bus_texto  = trim( $_POST['referencia'] ) ;
            $notificar_diasantes = trim( $_POST['dias_antes'] ) ;
            $notificar  = trim( $_POST['notifica_opcion'] ) ;
            $vto        = trim( $_POST['vto'] ) ;
            $obs        = trim( $_POST['obs'] ) ;
            $ubi_gabetas_id=trim($_POST['ubi_gavetas_id']);
            $hist_gabetas_id=trim($_POST['HistoricoGabetaid']);
            $categoriaid = trim($_POST['idcategoria']);
            $creador     = $_SESSION['usuario'] ;
            $path_server = '/almacen_digital' ;
            $fec_engabeta= date('Y-m-d', time());

            $marca=$_POST['marca'];

            $buscarFull = $bus_fecha.$bus_numero.$bus_texto ;

            $campos = array('titulo','bus_fecha','bus_numero','bus_texto','fecha_vto','obs',
            'buscarfull','ubi_gabetas_id','categoria_id','creador','fec_engabeta','notificar_diasantes','notificar_vto') ;

            $valores ="'".$titulo."','".$bus_fecha."','".$bus_numero."','".$bus_texto.
                        "','".$vto."','".$obs."','".$buscarFull.
                        "','".$ubi_gabetas_id."','".$categoriaid.
                        "','".$creador."','".$fec_engabeta."','".
                        $notificar_diasantes."','".$notificar."'" ;

            $accesoFunciones->modificarDato('documento',$campos,$valores,'id',$_POST['Idformulario'] );

//          si fue cambiado la gabeta, se registra en el historico el dato anterior de gabeta
            if($ubi_gabetas_id!=$hist_gabetas_id){
              $motivo = 'Modificado en ficha' ;
              $campoHistorico =array('documento_id','fec_fingabeta','mov_usuario','motivo','idgabeta') ;
              $HistoricoValores = "'".$_POST['Idformulario']."','".$fec_engabeta."','".$creador."','".$motivo."','".$hist_gabetas_id."'" ;

              // Registra en historico
             $accesoFunciones->insertarDato('historico_gabeta',$campoHistorico,$HistoricoValores);
            }


            if($marca!='indexa'){
                $_SESSION['message'] = $message;
                header("Location: doc_panel.php");
            }else {
                header("Location: docPendientes_panel.php");
            }
}
?>
