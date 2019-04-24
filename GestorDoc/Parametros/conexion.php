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
       //  if ($this->conexion == 0) DIE("Lo sentimos, no se ha podido conectar con MySQL: " . mysql_error());
       // return true;
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


    public function consultarDatos($campos,$tabla,$condicion=""){
        $texto=(implode(",", $campos));
        return $this->conexion->query("SELECT ".$texto." FROM ".$tabla." ");
    }


    public function eliminarDato($tabla,$campo,$identificador){
        mysqli_query("Delete from ".$tabla." where ".$campo."= ".$identificador." ");
    }


    public function insertarDato($tabla,$campos,$valores){
        $this->conexion->query( "INSERT INTO ".$tabla." ".(implode(",", $campos))." VALUES (".$valores.")" );
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
}

?>
