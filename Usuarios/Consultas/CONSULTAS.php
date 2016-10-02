<?php
require_once ("../../Includes/SESSION.php");
?>
<?php
require_once ("../../Includes/CONEXION.php");
?>
<?php
require_once ("../../Includes/FUNCIONES.php");
?>
<?php
require_once ("../../Includes/Diseno/CABEZERA.php");
?>
<?php
$var_mensaje = "";
$planta = "";
$producto = "";
$fechaSiembra = "";
$cantidadplantas = "";
$siguiente_pagina = "LISTAV.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACIONV.PHP?id=" . $_GET['id'];
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
<script>

    var countryApp = angular.module('App', []);
    countryApp.controller('ConsultasCtrl', function ($scope, $rootScope, $http) {

        $scope.tabla1 = [];
        $scope.tabla2 = [];
        $scope.tabla4 = [];



        $http.get('../../Includes/Productos/ORGANICO.PHP').success(function (data) {
            $scope.organico = data;

        });
        $http.get('../../Includes/Productos/QUIMICO.PHP').success(function (data) {
            $scope.quimico = data;
        });

        $scope.consultar_aplicaion = function () {

            $scope.ur = 'consulta_json?id=' + $scope.plantaSelecionada + '&consulta=aplicacion';
            $http.get('consulta_json?id=' + $scope.plantaSelecionada + '&consulta=aplicacion').success(function (data) {
                $scope.tabla1 = data;

            });
        };

        $scope.proximasAplicaciones = function () {           
            $http.get('consulta_json?consulta=proximasAplicaciones').success(function (data) {
                $scope.tabla4 = data;

            });
        };
        
        $scope.consultar_aplicacionp = function () {

            $scope.ur = 'consulta_json?id=' + $scope.productoSeleccionado + '&consulta=aplicacionprod';
            $http.get('consulta_json?id=' + $scope.productoSeleccionado + '&consulta=aplicacionprod').success(function (data) {
                $scope.tabla2 = data;

            });
        };
//        
//        
//        $scope.consultar_porFechaUnica = function () {
//
//            $scope.ur = 'consulta_json?id=' + $scope.fechaSeleccionada + '&consulta=consultafecha';
//            $http.get('consulta_json?id=' + $scope.productoSeleccionado + '&consulta=consultafecha').success(function (data) {
//                $scope.tabla4 = data;
//
//            });
//        };
        
        
        
        $scope.buscar_fechas = function () {

            $scope.ur = 'consulta_json?consulta=aplicacionFecha';

            if ($scope.desde != null) {
                $scope.ur += '&ini=' + $scope.desde.toLocaleDateString();
            }
            if ($scope.hasta != null) {
                $scope.ur += '&fin=' + $scope.hasta.toLocaleDateString();
            }
//            if ($scope.ur != 'consulta_json?consulta=aplicacionFecha') {
//                $http.get('consulta_json?id=' + $scope.plantaSelecionada + '&consulta=aplicacionFecha').success(function (data) {
//
//                    $scope.tabla4 = data;
//
//                });
//            }
        };
    });

</script>
<!DOCTYPE html>
<html ng-app="App">
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <title>CONSULTAS</title>
    </head>  
    <body ng-controller="ConsultasCtrl">
        <?php echo $cabezera ?>        
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
                    <input type="button" name="salir" value ="h" ng-click="proximasAplicaciones()">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-default">
                        <tr>
                            <th>PRODUCTOS APLICADOS</th>                          
                            <th>FECHA DE APLICACION</th>                    
                            <th>TRATAMIENTO</th> 
                            <th>CANTIDAD APLICADA</th>  
                            <th>PROXIMA APLICACION</th> 
                        </tr>   
                    </thead>
                    <tr ng-repeat="aplicacion in tabla1">
                        <th>{{aplicacion.nombre_com}}</th> 
                        <th>{{aplicacion.fecha_aplicacion}} </th> 
                        <th>{{aplicacion.tipotratamiento}}</th> 
                        <th>{{aplicacion.cant_aplicada}}</th>  
                        <th>{{aplicacion.fecha_prox}}</th>                                                                                                         
                    </tr> 
                </table>
            </div>

            {{ur}}   {{desde}}   {{hasta}}                  
            <h4> Cantidad Existente:</h4> ??           
            <h4> Vencimiento:</h4> ??            
            <?php ///////////////////////TABLA DE PRODUCTOS////////////////////////////////////?>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-default">
                        <tr>
                            <th>PLANTA APLICADA</th>   
                            <th>CANTIDAD APLICADA</th>                       
                            <th>FECHA DE APLICACION</th>                    
                        </tr>   
                    </thead>
                    <tr ng-repeat="aplicacionprod in tabla2">                         
                        <th>{{aplicacionprod.nomb_planta}} </th> 
                        <th>{{aplicacionprod.cant_aplicada}}</th>  
                        <th>{{aplicacionprod.fecha_aplicacion}}</th>                                                                                                                                 
                    </tr> 
                </table>
            </div>
            <?php ///////////////////////FECHAS////////////////////////////////////?>
                        <div class="table-responsive">
                <table class="table">
                    <thead class="thead-default">
                        <tr>
                             <th>PRODUCTO</th> 
                              <th>PLANTA</th> 
                            <th>TRATAMIENTO</th>   
                            <th>CANTIDAD</th>                       
                            <th>PROXIMA APLICACION</th>                    
                        </tr>   
                    </thead>
<!--                    <tr ng-repeat="consultafecha in tabla4">                         
                        <th>{{consultafecha.nombre_com}} </th> 
                        <th>{{consultafecha.nomb_planta}}</th>  
                        <th>{{consultafecha.tipotratamiento}}</th>
                        <th>{{consultafecha.cant_aplicada}}</th> 
                        <th>{{consultafecha.fecha_prox}}</th> 
                    </tr> -->
                </table>
            </div>
            
            
            <?php ///////////////////////PROXIMAS APLICACIONES////////////////////////////////////?>
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-default">
                        <tr>
                            <th>PROXIMA APLICACION</th>   
                            <th>PRODUCTO</th>                       
                            <th>PLANTA</th>                    
                            <th>TRATAMIENTO</th>  
                        </tr>   
                    </thead>
                
                    <tr ng-repeat="prox in tabla4">
                        <td>{{prox.fecha_prox}}</td>  
                        <td>{{prox.nombre_com}}</td>    
                        <td>{{prox.nomb_planta}}</td>
                        <td>{{prox.tipotratamiento}}</td>                         
                    </tr> 
                </table>
            </div>
        </div>
    

</body>
</html>
<?php

