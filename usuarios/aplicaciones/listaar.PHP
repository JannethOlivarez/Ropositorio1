
<?php
require_once ("../../includes/funciones.php");
require_once ("../../includes/conexion.php");
require_once ("../../includes/diseno/cabezera.php");
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
                <h2>Aplicaciones Reagendadas:</h2>
                <div class="table-responsive">
                    <table  class="table table-striped">
                    <thead class="thead-default">
                        <tr>
                            <th>N° Lote</th>  
                            <th>PLANTA</th>
                            <th>PRODUCTO</th>
                            <th>TRATAMIENTO</th>
                            <th>MOTIVO REAGENDAMIENTO</th>
                            <th>FECHA ANTIGUA</th>  
                            <th>FECHA NUEVA</th>  
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
                                
                        </tr>   
                    </thead>
                   <tr ng-repeat="aplicacion in aplicaciones_reagendadas">
                        <td>{{aplicacion.num_lote}}</td>                      
                        <td>{{aplicacion.nomb_planta}}</td>                       
                        <td>{{aplicacion.tipo_producto}}</td>
                        <td>{{aplicacion.tipotratamiento}}</td>
                        <td>{{aplicacion.motivo}}</td> 
                        <td>{{aplicacion.fecha_antigua | date : format : timezone}}</td>
                        <td>{{aplicacion.fecha_nueva  | date : format : timezone}}</td>
                        <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                        <td>{{unidad_label(aplicacion.estado_sl)}}</td>
                     
                     
               </table>                                        
                </div>
                
            </div>
        
        </div>
    </body>
</html>