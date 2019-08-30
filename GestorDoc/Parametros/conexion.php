<?php
/*$direccion = "127.0.0.1";
$bd = "gestordoc";
$usuario ="root";
$pass = "";
$con = $mysqli = new mysqli($direccion, $usuario, $pass, $bd);
$infoHost;
$error;
if ($mysqli->connect_errno) {
    $error="Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$infoHost=$mysqli->host_info . "\n";*/

class Conexion{
    private $user="root";
    private $ip="localhost";
    private $bd="gestordoc";
    private $pass="valurq123";
    public $conexion;


    public function __construct(){
        /*
            FUNCION UTILIZADA PARA PODER INSTANCIAR LA CLASE (CREAR EL OBJETO)
            $variable=new Conexion()
        */
        $this->conexion= new mysqli($this->ip,$this->user,$this->pass,$this->bd);

    }
    public function __construct1($user,$ip,$bd,$pass){
        /*
            FUNCION UTILIZADA PARA PODER INSTANCIAR LA CLASE (CREAR EL OBJETO) CON LA DIFERENCIA QUE SE INICIA CON LOS DATOS PROPORCIONADOS EN EL ARGUMENTO
            $variable=new Conexion(<USUARIO>,<ip del servidor>,<base de datos>,<contraseña>)
        */
        $conexion=mysql_connect($ip,$user,$pass,$bd);
        if ($this->conexion == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
       return true;
    }
}

//CLASE HEREDADA DE CONEXION
class Consultas extends Conexion{
    public function __construct(){
        /*
            CONSTRUCTOR DE LA CLASE CONSULTAS, SIRVE PARA INSTANCIAR (CREAR) UN OBJETO DEL TIPO Consultas
            $objetoConsultas = new Consultas();
        */
        parent::__construct();
    }



    public function consultarDatos($campos,$tabla,$orden="",$campoCondicion="",$valorCondicion=""){
        /*
            METODO PARA PODER OBTENER DATOS DE UNA TABLA ESPECIFICADA
            $objetoConsultas->consultarDatos(<Array de campos a consultar>,<tabla de la bd>,<Metodo de ordenar>,<condicion para la consulta>)
            Ej: $objetoConsultas->consultarDatos(['id','descripcion','categorias','order by id DESC']);
        */

        $texto=(implode(",", $campos));
        $query="SELECT ".$texto." FROM ".$tabla." ".$orden;
        if(($campoCondicion!="")&&($valorCondicion!="")){
            $query.="WHERE ".$campoCondicion." = '".$valorCondicion."' ";
            //echo $query;
        }
        return $this->conexion->query($query);
    }
    public function buscarDato($campos,$tabla,$campoCondicion,$valorCondicion){
         /*
            METODO PARA PODER OBTENER DATOS DE UNA TABLA ESPECIFICADA
            $objetoConsultas->consultarDatos(<Array de campos a consultar>,<tabla de la bd>,<Metodo de ordenar>,<condicion para la consulta>)
            Ej: $objetoConsultas->consultarDatos(['id','descripcion','categorias','order by id DESC']);
        */
        //$texto=(implode(",", $campos));
        $campos=implode(",",$campos);
        $query="SELECT ".$campos." FROM ".$tabla." WHERE ".$campoCondicion." LIKE '%".$valorCondicion."%' ";
            //echo $query;
        return $this->conexion->query($query);
    }


    public function eliminarDato($tabla,$campo,$identificador){
        /*
            METODO PARA ELIMINAR UN REGISTRO DE UNA TABLA FILTRANDOLO POR UN DATO DE UN CAMPO ESPECIFICADO
            $objetoConsultas->eliminarDato(<tabla de la bd>,<campo para filtrar>,<dato del campo a filtrar>)
            Ej:$objetoConsultas->eliminarDato('categorias','id','1');

        */
        $this->conexion->query("Delete from ".$tabla." where ".$campo."= '".$identificador."'");

    }

    public function insertarDato($tabla,$campos,$valores){
        /*
            METODO PARA INSERTAR UN REGISTRO NUEVO A LA BASE DE DATOS
            $objetoConsultas->insertarDato(<tablade la bd>,<Array de campos>,<string de valores>)
            $consulta->insertarDato('remision_enviada',['campo1','campo2','campo3'],"'valor1','valor2','valor3'");
            NOTA : los valores tienen que estar en un string, en el mismo orden que se pasaron los campos
        */
        
        $this->conexion->query("INSERT INTO ".$tabla." ( ".(implode(",", $campos))." ) VALUES (".$valores.")");

    }

    private function crearPaqueteModificacion($campos,$valores){
        $datos=explode(',',$valores);
        $campos=explode(',',implode($campos,','));
        $resultado="";
        for($i=0;$i<count($campos)-1;$i++){
            $resultado.= "".$campos[$i]."=".$datos[$i]." , ";
        }
        $resultado.= "".$campos[$i]."=".$datos[$i]." ";
        return $resultado;
    }
    public function modificarDato($tabla,$campos,$valores,$campoIdentificador,$valorIdentificador){
        /*
            METODO PARA INSERTAR UN REGISTRO NUEVO A LA BASE DE DATOS
            $objetoConsultas->insertarDato(<tablade la bd>,<Array de campos>,<string de valores>)
            $consulta->insertarDato('remision_enviada',['campo1','campo2','campo3'],"'valor1','valor2','valor3'");
            NOTA : los valores tienen que estar en un string, en el mismo orden que se pasaron los campos
        */
        //$this->crearPaqueteModificacion($campos,$valores);
        //echo"UPDATE ".$tabla." SET ".$this->crearPaqueteModificacion($campos,$valores)." WHERE ".$campoIdentificador." = '".$valorIdentificador."'";
        $this->conexion->query("UPDATE ".$tabla." SET ".$this->crearPaqueteModificacion($campos,$valores)." WHERE ".$campoIdentificador." = '".$valorIdentificador."'");

    }

    public function crearTabla($cabecera,$camposBD,$tabla,$condicion="",$tamanhos=['*']){
        /*
            METODO PARA PODER CREAR UNA TABLA EN EL LUGAR DONDE FUE INVOCADO EL METODO
            $objetoConsultas->crearTabla(<Array de cabeceras>,<array de los campos>.<nombre de la tabla>,<condicion de busqueda>,<tamaños de las columnas>);
            $objetoConsultas->crearTabla(['ID','Categoria'],['id','nom_categoria'],'categorias')
        */
        echo "<table id='tablaPanel' cellspacing='0' style='width:100%'>";
        array_unshift($camposBD,"id");
        $this->crearCabeceraTabla($cabecera,$tamanhos);
        $res=$this->consultarDatos($camposBD,$tabla,$condicion);
        $this->crearContenidoTabla($res);
    }


    public function crearCabeceraTabla($titulos,$tamanhos=['*']){
        /*
            METODO PARA PODER CREAR LOS TITULOS DE UNA TABLA
            $objetoConsultas->crearCabeceraTabla(<Array de nombres de cabecera>,<array de tamaños para las columnas>)
        */
        echo"<thead style='width:100%'>";
        echo "<tr>";
        for($i=0;$i<count($titulos);$i++){
            if(count($tamanhos)<$i+1){
                echo"<td class='titulo-tabla'>".$titulos[$i]."</td>";
            }else{
                echo"<td style='width:".$tamanhos[$i]."' class='titulo-tabla'>".$titulos[$i]."</td>";
            }
        }
        echo "</tr>";
        echo"</thead>";
    }
   private function crearContenidoTabla($resultadoConsulta){
        /*
            METODO PARA PODER CREAR LOS DATOS DENTRO DE UNA TABLA
            $objetoConsultas->crearContenidoTabla(<Resultado de consulta a la base de datos>);
        */
        echo "<tbody id='datosPanel'>";
        while($datos=$resultadoConsulta->fetch_array(MYSQLI_NUM)){
            echo "<tr class='datos-tabla' onclick='seleccionarFila($datos[0])' id='".$datos[0]."'>";
            array_shift($datos);
            foreach( $datos as $valor ){
                echo "<td>".$valor." </td>";
            }
            echo "</tr>";
        }
        echo"</tbody>";
    }
    public function opciones_sino($nombreOpcion,$valor) {
     if($valor=="si" || $valor=="no" ) {
       // MODIFICA REGISTRO
           $opcion_sino="<select name='".$nombreOpcion."' style='width:80px'>";
           if($valor=="si"){
             $opcion_sino.= "<option value='no'>NO</option>" ;
             $opcion_sino.= "<option selected value='".$valor."'>".strtoupper($valor)."</option>" ;
           }else{
             $opcion_sino.= "<option value='si'>SI</option>" ;
             $opcion_sino.= "<option selected value='".$valor."'>".strtoupper($valor)."</option>" ;
             }
           $opcion_sino.="</select>";
         }else{
           // NUEVO REGISTRO
           $opcion_sino="<select name='".$nombreOpcion."' style='width:80px'>";
           $opcion_sino.= "<option value='si'>SI</option>" ;
           $opcion_sino.= "<option value='no'>NO</option>" ;
           $opcion_sino.="</select>";
         }


      echo $opcion_sino;
    }
    public function consultarMenu($usuario){
        /*
            METODO PARA PODER CONSULTAR DATOS REFERENTES AL MENU
            $objetoConsultas->consultarMenu(<ID de usuario>)
        */
        $sql="SELECT link_acceso,icono,titulo_menu,(SELECT habilita FROM acceso
             WHERE menu_opcion_id = menu_opcion.id AND
              perfil_id=(SELECT perfil_id FROM usuario WHERE id=".$usuario." ))
              AS habilitar
        FROM menu_opcion
        WHERE id IN( SELECT menu_opcion_id FROM acceso
            WHERE perfil_id = ( SELECT perfil_id FROM usuario
                WHERE id= '".$usuario."' ) ) order by posicion asc";

        $resultado=$this->conexion->query($sql);
        return $resultado;
    }

    public function consultarInformes(){
        /*
            METODO PARA PODER CONSULTAR OPCIONES DE LOS INFORMES
            $objetoConsultas->consultarInformes()
        */
        $sql="SELECT url,titulo FROM informes order by titulo asc";
        $resultado=$this->conexion->query($sql);
        return $resultado;
    }

    public function crearMenuDesplegable($nombreLista,$campoID,$campoDescripcion,$tabla){
        /*
            METODO PARA CREAR UN MENU DESPLEGALBE CON LOS CAMPOS DE DESCRIPCION COMO VALOR MOSTRADO Y EL ID EN EL VALOR DE CADA OPCION/
            $obj->crearMenuDesplegable("nombre_para_el_select","nombre_de_campo_id_en_tabla","nombre_de_campo_descripcion_o_nombre_a_mostrar","tabla_donde_consultar")
        */
        $lista="<select name='".$nombreLista."'>";
        $campos= array($campoID,$campoDescripcion );
        $resultado=$this->consultarDatos($campos,$tabla);
        $lista.=$this->crearOpciones($resultado);
        $lista.="</select>";
        echo $lista;
    }


    public function crearOpciones($resultadoConsulta){

        $opciones="";
        while($datos=$resultadoConsulta->fetch_array(MYSQLI_NUM)){
                $opciones.="<option value='".$datos[0]."'>".$datos[1]."</option>";
        }
        return $opciones;
    }
    public function DesplegableElegido($idElegido, $nombreLista,$campoID,$campoDescripcion,$tabla){
        /*
            Metodo que permite mostrar una opcion seleccionada y grabada
            previamente. Utilizado par EDICION / MODIFICA y que traiga el valor
            de la tabla.
            parametros :
            $idElegido : identificador del registro a buscar
            $nombreLista : nombre del select, objeto de $lista
            $campoID : nombre del campo id en la tabla
            $campoDescripcion : nombre del campo de la descrip.en la tabla
            $tabla : nombre de la tabla
        */
        $lista="<select name='".$nombreLista."'>";
        $campos= array($campoID,$campoDescripcion );
        $resultado=$this->consultarDatos($campos,$tabla);
        $lista.=$this->OpcionesElegidas($resultado, $idElegido);
        $lista.="</select>";
        echo $lista;
    }

    public function OpcionesElegidas($resultadoConsulta,$idelegido){

        $opciones="";
        while($datos=$resultadoConsulta->fetch_array(MYSQLI_NUM)){
              if ($datos[0]==$idelegido ){
                $opciones.="<option selected  value='".$datos[0]."'>".$datos[1]."</option>";
              }else{
                $opciones.="<option value='".$datos[0]."'>".$datos[1]."</option>";
              }
      }
        return $opciones;
    }
}

?>
