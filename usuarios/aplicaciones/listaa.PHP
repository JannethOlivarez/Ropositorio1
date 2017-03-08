
<?php
require_once ("../../includes/funciones.php");
require_once ("../../includes/conexion.php");
require_once ("../../includes/diseno/cabezera.php");
?>

<?php
$var_mensaje = "";
/* @var $_POST type */

if (isset($_POST['submit'])) {

    $nombreProducto = $_POST['nombreprod'];
    $nombrePlanta = $_POST['nombreplanta'];
    echo $nombreProducto;
    $tratamiento = $_POST['tratamiento'];
    $cantidad = $_POST['cantidad'];
    $fechaAplicacion = $_POST['fechaAplicacion'];
    $fechaProxima = $_POST['proximaAplicacion'];
    $unidad = $_POST['unidad'];
    $tipo_sl = $_POST['estado_sl'];

    if (logged_in()) {
        $var_mensaje = Aplicacion($nombrePlanta, $nombreProducto, $tratamiento, $cantidad, $fechaAplicacion, $fechaProxima, $unidad, $tipo_sl);
        $var_mensaje = "Datos";
    } else {
        
    }
}
?>
<script src="../../js/angular.min.js"></script>
<script src="../../js/miangular.js"></script>
<!DOCTYPE html>
<html ng-app="App">
   <?php echo $cabezera; ?>	
    <body ng-controller="PlantaCtrl">
        <div class="row">              
            <title>Plantas no tradicionales</title>
            <div class="container">
                <a href="ingresoa.PHP">Agregar nueva Aplicacion</a> 
                <a href="listaar.PHP">Registro de Reagendamientos</a>
                <h2>Aplicaciones Pendientes:</h2>
                <div class="table-responsive">
                <table  class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>N° Lote</th>  
                            <th>PLANTA</th>
                            <th>TIPO DE PRODUCTO</th>
                            <th>TRATAMIENTO</th>  
                            <th>PRODUCTO</th>  
                            <th colspan="2">CANTIDAD APLICADA
                              
                                <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                                        ng-model="unidad_sel_liquido" required> 
                                </select>  
                               
                                <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                                        ng-model="unidad_sel_solido" required> 
                                </select> 
                            </th>  
                            <th>FECHA APLICACION</th>  
                            <th>PROXIMA APLICACION</th>     
                        </tr>   
                    </thead>
                    <tr ng-repeat="aplicacion in aplicaciones">
                        <td>{{aplicacion.num_lote}}</td>                      
                        <td>{{aplicacion.nomb_planta}}</td>                       
                        <td>{{aplicacion.tipo_producto}}</td>
                        <td>{{aplicacion.tipotratamiento}}</td>
                        <td>{{aplicacion.nombre_com}}</td>   
                        <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                        <td>{{unidad_label(aplicacion.estado_sl)}}</td>
                        <td>{{aplicacion.fecha_aplicacion| date : format : timezone}}</td> 
                        <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>  
                        <td colspan="2">
                            <a href="ingresoa.PHP?id={{aplicacion.id_aplicacion}}">Actualizar</a><br>
                            <a href="cestado.PHP?id={{aplicacion.id_aplicacion}}&completar=si">Cumplida</a><br>
                            <a href="cestado.PHP?id={{aplicacion.id_aplicacion}}">Nueva fecha</a><br>                            
                        </td>  
               </table>                                                                
                </div>                
                <h2>Aplicaciones Realizadas:</h2>
                <div class="table-responsive">
                    <table  class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>N° Lote</th>  
                            <th>PLANTA</th>
                            <th>TIPO DE PRODUCTO</th>
                            <th>TRATAMIENTO</th>  
                            <th>PRODUCTO</th>  
                            <th colspan="2">CANTIDAD APLICADA
                                <br>
                                <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                                        ng-model="unidad_sel_liquido" required> 
                                </select>  
                                <br>
                                <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                                        ng-model="unidad_sel_solido" required> 
                                </select> 
                            </th>  
                            <th>FECHA APLICACION</th>  
                            <th>PROXIMA APLICACION</th>     
                        </tr>   
                    </thead>
                   <tr ng-repeat="aplicacion in aplicaciones_pasadas">
                        <td>{{aplicacion.num_lote}}</td>                      
                        <td>{{aplicacion.nomb_planta}}</td>                       
                        <td>{{aplicacion.tipo_producto}}</td>
                        <td>{{aplicacion.tipotratamiento}}</td>
                        <td>{{aplicacion.nombre_com}}</td>   
                        <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                        <td>{{unidad_label(aplicacion.estado_sl)}}</td>
                        <td>{{aplicacion.fecha_aplicacion| date : format : timezone}}</td> 
                        <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>  
                        <td colspan="2">
                            <a ng-show="reagendar(aplicacion.efectuada)" href="cestado.PHP?reagendar=si&id={{aplicacion.id_aplicacion}}">Reagendar</a><br>
                        </td>  
               </table>                                        
                </div>
                
            </div>
        
        </div>
    </body>
</html>