
<?php
require_once ("../../includes/conexion.php");
?>
<?php
require_once ("../../includes/funciones.php");
?>
<?php
require_once ("../../includes/diseno/cabezera.php");
?>
<?php
$var_mensaje = "";
$planta = "";
$producto = "";
$fechaSiembra = "";
$cantidadplantas = "";
$siguiente_pagina = "listav.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "actualizacionv.PHP?id=" . $_GET['id'];
    $vinculacion_buscada = obtener_Vinculacion_por_id($_GET['id']);
    if ($vinculacion_buscada != NULL) {
        $planta = $vinculacion_buscada[0]['id_planta'];
    }
    $producto_buscado = obtener_producto_por_id($_GET['id']);
    if ($producto_buscado != NULL) {
        $producto = $producto_buscado[0]['nombre_com'];
    }
}
$plantas = obtener_todas_plantas();
$productos = optener_todos_productos()
?>
<?php
$var_mensaje = "";
/* @var $_POST type */
if (isset($_POST['h'])) {
    $nombreProducto = $_POST['nombreprod'];
    $nombrePlanta = $_POST['nombreplanta'];
    echo $nombreProducto;
    $tratamiento = $_POST['tratamiento'];
    $cantidad = $_POST['cantidad'];
    $fechaAplicacion = $_POST['fechaAplicacion'];
    $fechaProxima = $_POST['proximaAplicacion'];
    if (logged_in()) {
        $var_mensaje = Aplicacion($nombrePlanta, $nombreProducto, $tratamiento, $cantidad, $fechaAplicacion, $fechaProxima);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}
?>



<script src="../../js/angular.min.js"></script>
<script src="../../js/moment.min.js"></script>
<script src="../../js/consultas.js"></script>

<!DOCTYPE html>
<html ng-app="App">
    <?php echo $cabezera ?>    
    <body ng-controller="ConsultasCtrl">

        <div class="row">
            <div class="container">
                <h2 class="text-center">REGISTROS</h2>  
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">                    
                        <h3> Seleccionar Planta</h3> 
                        <select ng-model="plantaSelecionada" name="planta" ng-change="consultar_aplicaion()">
                            <?php foreach ($plantas as $planta) { ?>
                                <option value="<?php echo $planta['cod_planta']; ?> "><?php echo $planta['nomb_planta']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">                    
                        <h3> Seleccionar Producto:</h3>
                        
                        <select ng-model="productoSeleccionado" name="producto" ng-change="consultar_aplicacionp()">
                            <?php foreach ($productos as $producto) { ?>
                                <option value="<?php echo $producto['id_producto']; ?> "><?php echo $producto['nombre_com']; ?></option>
                            <?php } ?>
                        </select>                   
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">                   
                        <h3> Seleccionar Fecha:</h3> 

                        Desde:<input ng-model="desde" type="date" name="fecha"><br>
                        Hasta:<input ng-model="hasta" type="date" name="fecha">
                        <input class="btn btn-success "  type="button" ng-click="buscar_fechas()" name="submit" value=">>">
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <h3>Próximas Aplicaciones</h3>
                        <input class="btn btn-default" type="button" name="salir" value ="Todas aplicaciones" ng-click="proximasAplicaciones()">
                        <input class="btn btn-default" type="button" name="salir" value ="Aplicaciones hoy" ng-click="aplicaciones_hoy()">
                        <input class="btn btn-default" type="button" name="salir" value ="Aplicaciones pròxima_semana" ng-click="aplicaciones_proxima_semana()">
                     <input class="btn btn-default" type="button" name="salir" value ="Aplicaciones de Este mes" ng-click="proximas_aplicaciones_mes()">
                     <input class="btn btn-default" type="button" name="salir" value ="Aplicaciones pròximo mes" ng-click="proximas_aplicaciones_proximo_mes()">
                    </div>
                </div>
                <hr  style="color: #000" size="8" align="center">
<!--                {{ur}}-->
                <div ng-show="mostrar_aplicaciones">
                    <h3>Aplicaciones</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-default">
                                <tr>
                                    <th>N° LOTE</th>  
                                    <th ng-show="mostra_planta">PLANTA</th>
                                    <th>TRATAMIENTO</th>
<!--                                    <th ng-show="mostra_planta">TIPO DE PRODUCTO</th>  -->
                                    <th ng-show="mostrar_producto">PRODUCTO</th> 
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
                                    <th ng-show="mostrar_producto">PROXIMA APLICACION</th> 
                                    <th ng-show="mostra_planta">FECHA APLICACION</th> 
                                    <th >Edad Actual P.</th> 
                                </tr>   
                            </thead>
                          
                            <tr ng-repeat="aplicacion in tabla1">
                                <td>{{aplicacion.num_lote}}</td>                      
                                <td ng-show="mostra_planta" >{{aplicacion.nomb_planta}}</td>                       
                                <td>{{aplicacion.tipotratamiento}}</td>
<!--                                <td ng-show="mostra_planta">{{aplicacion.tipo_producto}}</td>-->
                                <td ng-show="mostrar_producto">{{aplicacion.nombre_com}}</td>   
                                <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                                <td>{{unidad_label(aplicacion.estado_sl)}}</td>
                                <td  ng-show="mostrar_producto"> {{aplicacion.fecha_prox | date : format : timezone}}</td>     
                                <td  ng-show="mostra_planta">{{aplicacion.fecha_aplicacion| date : format : timezone}}</td> 
                                 <td  ng-show="mostra_planta">{{aplicacion.edad}}</td> 
                            </tr> 
                            <tr>
                                <td colspan="8">{{tabla1.length}} Registros</td> 
                            </tr>
                        </table>
                    </div>
                </div> 

                <div ng-show="mostrar_proxima_semana">
                    <h2>Aplicaciones Proxima Semana</h2>
                    <table class="table">
                        <thead class="thead-default">
                            <tr>
                                <th>N° Lote</th>  
                                <th>PLANTA</th>
                                <th>TRATAMIENTO</th>
<!--                                <th>TIPO DE PRODUCTO</th>  -->
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
                                <th>PROXIMA APLICACION</th> 
                                <th >Edad Actual P.</th> 
                            </tr>   
                        </thead>
                        <!--Lunes-->
                        <tr >
                            <td colspan="8">{{fecha[0].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[0].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>
                        <!--Martes-->
                        <tr >
                            <td colspan="8">{{fecha[1].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[1].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>
                        <!--Miercoles-->
                        <tr >
                            <td colspan="8">{{fecha[2].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[2].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>                        
                        <!--Jueves-->
                        <tr >
                            <td colspan="8">{{fecha[3].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[3].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>
                        <!--Viernes-->
                        <tr >
                            <td colspan="8">{{fecha[4].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[4].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>                        
                        <!--Sabado-->
                        <tr >
                            <td colspan="8">{{fecha[5].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[5].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>                        
                        <!--Domingo-->
                        <tr >
                            <td colspan="8">{{fecha[6].larga| uppercase}}</td> 
                        </tr>
                        <tr ng-repeat="aplicacion in tabla2| filter:fecha[6].corta:strict">
                            <td>{{aplicacion.num_lote}}</td>                      
                            <td>{{aplicacion.nomb_planta}}</td>                       
<!--                            <td>{{aplicacion.tipo_producto}}</td>-->
                            <td>{{aplicacion.tipotratamiento}}</td>
                            <td>{{aplicacion.nombre_com}}</td>   
                            <td>{{cantidad(aplicacion.estado_sl, aplicacion.cant_aplicada)}}</td> 
                            <td>{{unidad_label(aplicacion.estado_sl)}}</td>                        
                            <td>{{aplicacion.fecha_prox| date : format : timezone}}</td>                                                                                                        
                        </tr>
                        <tr >
                            <td colspan="8">{{tabla2.lenght}}</td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
<?php

