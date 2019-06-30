<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <?php
            include('Parametros/conexion.php');
            $consulta= new Consultas();
        ?>
        <meta charset="utf-8">
        <script
  			  src="Js/jquery-3.4.0.js"
  			  integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
  			  crossorigin="anonymous"></script>
          <script type="text/javascript" src="Js/funciones.js"></script>
        <title></title>
    </head>
    <body>
        <?php
            $consulta->crearMenuDesplegable('usuarioSel','id','usuario','usuario');
        ?>
        <input type="button" value="Agregar" onclick="insertarTablaDetalle('1','1','usuario_grupo')">
        <table id="tabla-usuarios-grupos" class="tabla-form" border="1">
            <thead>
                <tr>
                    <td>Usuario</td>
                    <td></td>
                </tr>
            </thead>
            <tbody id="datos-usuarios-grupos">

            </tbody>
        </table>
    </body>
    <script>
        function insertarTablaDetalle(id,grupoId,tabla){
            var datos="";
            datos=datos.concat(id,"#",grupoId);
            var campos="";
            campos=campos.concat('grupos_id',"#",'usuario_id');
            $.post("Parametros/insertarDetalle.php", {datos : datos ,campos : campos, tabla:tabla}, function(resultado) {

            });
        }
    </script>
</html>
