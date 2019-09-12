<?php

  include("Parametros/conexion.php") ;
  $accesoFunciones=new Consultas() ;
  $message = '';
  $img = $_FILES['img'];

  if(!empty($img))
  {
    $Dato_archivos = reArrayFiles($img);
    /*
          PROCESO DE GRABACION PARA DOCUMENTO NUEVO
    */
          $camposConsultar = array('extensiones','prefijo') ;
          $datosParametros = $accesoFunciones->consultarDatos($camposConsultar,'parametros') ;
          $Parametros = $datosParametros->fetch_array(MYSQLI_BOTH);

          $campos = array('datos_upload','ubi_gabetas_id','categoria_id','creador',
          'path_server','nombre_final','fec_engabeta','bus_fecha','nombre_origen','titulo') ;

            // Verifica si los archivos tienen las extensiones permitidas.
            $permitidos = explode("-",$Parametros['extensiones']) ;
            $extensionesPermitidas = $permitidos ;
            //$extensionesPermitidas = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');


      foreach($Dato_archivos as $val)
      {
          $consultaId = $accesoFunciones->consultarDatos(array('id'),'documento','order by id desc limit 1','') ;
          $ultimoID = $consultaId->fetch_array(MYSQLI_BOTH);

          // Se obtiene datos del archivo cargado
          $fileTmpPath = $val['tmp_name'];
          $fileName   = $val['name'];
          $fileSize   = $val['size'];
          $fileType   = $val['type'];

          // separa extension del archivo
          $fileNameCmps = explode(".", $fileName);
          $fileExtension = strtolower(end($fileNameCmps));

          // Sanea el nombre del archivo
          $secuencia= $ultimoID['id']+1 ;
          $newFileName = $Parametros['prefijo'].$secuencia.".".$fileExtension;
          //$newFileName = md5(time() . $fileName) . '.' . $fileExtension;

          $titulo = 'Sin titulo' ;
          $bus_fecha  = date('Y-m-d', time());
          $ubi_gabetas_id=trim($_POST['ubi_gavetas_id']);
          $categoriaid  = trim($_POST['idcategoria']);
          $creador    ="creador" ;
          $path_server ='/almacen_digital' ;
          $fec_engabeta=date('Y-m-d', time());

          $nombreOrigen = 'carga masiva' ;
          $datosUpload= "tmp:".trim($fileTmpPath).
                         " size:".trim($fileSize).
                         " tipo:".trim($fileType);
//          valores a grabar en la BD
          $valores = "'".$datosUpload."','".$ubi_gabetas_id."','".$categoriaid.
                      "','".$creador."','".$path_server."','".$newFileName.
                      "','".$fec_engabeta."','".$bus_fecha."','".$nombreOrigen.
                      "','".$titulo."'" ;

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

          }else{$message = 'Fallo la carga. Tipo de archivos  permitidos: ' . implode(',', $extensionesPermitidas);}


    }
}
    $_SESSION['message'] = $message;
       //echo $message ;
       header("Location: adjuntaMasivo_form.php");

  function reArrayFiles($file)
  {
      $file_ary = array();
      $file_count = count($file['name']);
      $file_key = array_keys($file);

      for($i=0;$i<$file_count;$i++)
      {
          foreach($file_key as $val)
          {
              $file_ary[$i][$val] = $file[$val][$i];
          }
      }
      return $file_ary;
  }

?>
