
<?php
require_once ("../../includes/conexion.php");
?>
<?php
require_once ("../../includes/funciones.php");
?>
<?php
require_once ("../../includes/diseno/cabezera.php");
?>
<script src="../../js/angular.min.js"></script>
<script>
    var countryApp = angular.module('App', []);
    countryApp.controller('ProductoCtrl', function ($scope, $rootScope, $http) {
        $scope.unidades = [];
        $scope.unidades_liquido = [
            {id: 1, label: "ml", conversion: 0.001},
            {id: 2, label: "cl", conversion: 0.01},
            {id: 3, label: "dl", conversion: 0.1},
            {id: 4, label: "litro", conversion: 1},
            {id: 5, label: "galon", conversion: 3.7854}
        ];
        $scope.unidades_solido = [
            {id: 0, label: "mg", conversion: 0.000001},
            {id: 1, label: "cg", conversion: 0.00001},
            {id: 2, label: "dg", conversion: 0.0001},
            {id: 3, label: "gramo", conversion: 0.001},
            {id: 4, label: "kg", conversion: 1},
            {id: 4, label: "Oz", conversion: 0.0283495},
            {id: 4, label: "Lb", conversion: 0.453592},
            {id: 5, label: "Quintal", conversion: 100}
        ];
        $scope.cambiar_unidades = function (vari) {
            if (vari == 1) {
                $scope.unidades = $scope.unidades_liquido;
                $scope.unidad_sel = {id: 4, label: "litro", conversion: 1};
            } else {
                $scope.unidades = $scope.unidades_solido;
                $scope.unidad_sel = {id: 5, label: "kg", conversion: 1000};
            }

        };


    });
</script>
<?php
$var_mensaje = "";
$tipo = "";
$nombrec = "";
$principioa = "";
$cantidadp = "";
$fechaelab = "";
$fechacadu = "";
$siguiente_pagina = "listap.PHP";
$estado_actividad = 0;
if (isset($_GET['id'])) {
    $siguiente_pagina = "actualizacionpmasp.PHP?id=" . $_GET['id'];
    $producto_buscado = obtener_producto_por_id($_GET['id']);
    if ($producto_buscado != NULL) {
        $tipo = $producto_buscado[0]['tipo_producto'];
        $nombrec = $producto_buscado[0]['nombre_com'];
        $principioa = $producto_buscado[0]['principio_activo'];
        $cantidadp = $producto_buscado[0]['cantidad_prod'];
        $fechaelab = $producto_buscado[0]['fecha_elab'];
        $fechacadu = $producto_buscado[0]['fecha_cadu'];
        $estado_actividad = $producto_buscado[0]['estado_actividad'];
        $estadado_sl = $producto_buscado[0]['estado_sl'];
    }
}
?>

<!DOCTYPE html>
<html ng-app="App">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     

    </head>
    <body ng-controller="ProductoCtrl">
        <div class="row">

            <?php echo $cabezera; ?>
            <div class="container">
                <h2> <?php echo $nombrec; ?> </h2>
                <div id="contenido Productos">

                    <form action="<?php echo $siguiente_pagina; ?>" method="post">
                        <table>

                            <tr>
                                <td></td>
                                <td>   
                                    <?php
                                    if (strcmp($estadado_sl, "solido") == 0) {
                                        echo '<input type="radio" name="tipo_sl" value="S" ng-model="estado" required ng-click="cambiar_unidades(0)" checked> Sòlido ';
                                    } else {
                                        echo '<input type="radio" name="tipo_sl" value="L" ng-model="estado" ng-click="cambiar_unidades(1)" checked>Lìquido';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr><td><br> </td></tr>
                            <tr>
                                <td>Cantidad existente</td>
                                <td> <?php echo $cantidadp; ?>  </td>
                            </tr>
                            <tr>
                                <td>Fecha de Elaboración:</td>
                                <td>
                                   <?php echo $fechaelab; ?>

                                </td>
                            </tr>
                            <tr>
                                <td>Fecha de Vencimiento:</td>
                                <td>
                                    <?php echo $fechacadu; ?>
                                </td>
                            </tr>
                          

                            <tr><td><br> </td></tr>
                            <tr>
                                <td>Cantidad Aumentar Producto:</td>
                                <td>
                                    <input type="text" name="cantidadp" maxlength="10" value="" required>
                                </td>
                                <td>

                                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades track by unidad.id"
                                            ng-model="unidad_sel" required> 
                                    </select>  
                                </td>                 
                            </tr> 
                            <tr>
                                <td>Fecha de Elaboración:</td>
                                <td>
                                    <input type="date" name="fechaelab"  required>

                                </td>
                            </tr>
                            <tr>
                                <td>Fecha de Vencimiento:</td>
                                <td>
                                    <input type="date" name="fechacadu"   required>
                                </td>
                            </tr>
                                
                            <tr>
                                <td colspan="2">
                                    <input class="btn btn-success" type="submit" name="submit" value="Aceptar">
                                    <a href="listap.PHP">Lista de Productos</a></td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>

        </div>
    </body>
</html>
