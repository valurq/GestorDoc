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
        $this->conexion= new mysqli($this->ip,$this->user,$this->pass,$this->bd);

    }
    public function __construct1($user,$ip,$bd,$pass){
        $conexion=mysql_connect($ip,$user,$pass,$bd);
        if ($this->conexion == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
       return true;
    }
}
//CLASE HEREDADA DE CONEXION
class Consultas extends Conexion{
    public function __construct(){
        parent::__construct();
    }


    public function consultarDatos($campos,$tabla,$orden="",$condicion=""){
      // objetivo: obtiene datos de una tabla
      // sintaxis:   xx = new consultas() ;
      //                xx->consultarDatos([campos a obtener],[nombre de tabla],[opcional]);
      // nota: include de conexion
        $texto=(implode(",", $campos));
        return $this->conexion->query("SELECT ".$texto." FROM ".$tabla." ".$orden);
    }


    public function eliminarDato($tabla,$campo,$identificador){
        $this->conexion->query("Delete from ".$tabla." where ".$campo."= '".$identificador."'");

    }
    /*
    $consulta->insertarDato('remision_enviada',['campo1','campo2','campo3'],"'valor1','valor2','valor3'")
    */
    public function insertarDato($tabla,$campos,$valores){
        $this->conexion->query("INSERT INTO ".$tabla." ".(implode(",", $campos))." VALUES (".$valores.")");
    }

    public function crearTabla($cabecera,$camposBD,$tabla,$condicion="",$tamanhos=['*']){
        echo "<table style='width:100%'>";
        array_unshift($camposBD,"id");
        $this->crearCabeceraTabla($cabecera,$tamanhos);
        $res=$this->consultarDatos($camposBD,$tabla,$condicion);
        $this->crearContenidoTabla($res);
    }


    public function crearCabeceraTabla($titulos,$tamanhos=['*']){
        echo"<thead style='width:100%'>";
        echo "<tr>";
        for($i=0;$i<count($titulos);$i++){
            if(count($tamanhos)<$i+1){
                echo"<td class='titulo-tabla'>".$titulos[$i]."</td>";
            }else{
                echo"<td style='width:>".$tamanhos[$i]."' class='titulo-tabla'>".$titulos[$i]."</td>";
            }
        }
        echo "</tr>";
        echo"</thead>";
    }



   public function opciones_sino($nombreOpcion)
   {
     $opcion_sino="<select name='".$nombreOpcion."' style='width:80px'>";
     $opcion_sino.= "<option value='si'>SI</option>" ;
     $opcion_sino.= "<option value='no'>NO</option>" ;
     $opcion_sino.="</select>";
     echo $opcion_sino;
   }


    public function crearContenidoTabla($resultadoConsulta){
        echo "<tbody>";
        while($datos=$resultadoConsulta->fetch_array(MYSQLI_NUM)){
            echo "<tr onclick='seleccionarFila($datos[0])' id='".$datos[0]."'>";
            array_shift($datos);
            foreach( $datos as $valor ){
                echo "<td>".$valor." </td>";
            }
            echo "</tr>";
        }
        echo"</tbody>";
    }
    public function consultarMenu($usuario){
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

/*
    LLAMADA
        $obj->crearMenuDesplegable("nombre_para_el_select","nombre_de_campo_id_en_tabla","nombre_de_campo_descripcion_o_nombre_a_mostrar","tabla_donde_consultar")
*/
    public function crearMenuDesplegable($nombreLista,$campoID,$campoDescripcion,$tabla){
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
}

?>
