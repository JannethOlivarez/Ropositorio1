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
                $scope.unidad_sel =  {id: 4, label: "litro", conversion: 1};
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
$siguiente_pagina = "LISTAP.PHP";
$estado_actividad = 0;
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACIONP.PHP?id=" . $_GET['id'];
    $producto_buscado = obtener_producto_por_id($_GET['id']);
    if ($producto_buscado != NULL) {
        $tipo = $producto_buscado[0]['tipo_producto'];
        $nombrec = $producto_buscado[0]['nombre_com'];
        $principioa = $producto_buscado[0]['principio_activo'];
        $cantidadp = $producto_buscado[0]['cantidad_prod'];
        $fechaelab = $producto_buscado[0]['fecha_elab'];
        $fechacadu = $producto_buscado[0]['fecha_cadu'];
        $estado_actividad = $producto_buscado[0]['estado_actividad'];
    }
}
?>

<!DOCTYPE html>
<html ng-app="App">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body ng-controller="ProductoCtrl">
        <div class="row">
            <?php echo $cabezera; ?>
            <div class="container">
                <div id="contenido Productos">
                    <h2>Ingrese los datos del nuevo producto:</h2>
                    <form action="<?php echo $siguiente_pagina; ?>" method="post">
                        <table>
                            <tr>
                                <td>Tipo de Producto:</td>
                                <td>                        
                                    <input type="radio" name="tipo" value="ORGANICO" required <?php echo estado_check("ORGANICO", $tipo) ?>> Orgánico                        
                                    <input type="radio" name="tipo" value="QUIMICO" <?php echo estado_check("QUIMICO", $tipo) ?>>Químico
                                    <br>

                                </td>
                            </tr>
                            <tr>
                                <td>Nombre Comercial:</td>
                                <td>
                                    <input type="text" name="nombrec" maxlength="20" value="<?php echo $nombrec; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Principio Activo:</td>
                                <td>
                                    <input type="text" name="principioa" maxlength="25" value="<?php echo $principioa; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>                        
                                    <input type="radio" name="tipo_sl" value="S" ng-model="estado" required ng-click="cambiar_unidades(0)" > Sòlido                        
                                    <input type="radio" name="tipo_sl" value="L" ng-model="estado" ng-click="cambiar_unidades(1)">Lìquido
                                    <br>

                                </td>
                            </tr>
                            <tr>
                                <td>Cantidad Total de Producto:</td>
                                <td>
                                    <input type="text" name="cantidadp" maxlength="10" value="<?php echo $cantidadp; ?>" required>
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
                                    <input type="date" name="fechaelab" value="<?php echo $fechaelab; ?>"required>

                                </td>
                            </tr>
                            <tr>
                                <td>Fecha de Vencimiento:</td>
                                <td>
                                    <input type="date" name="fechacadu"  value="<?php echo $fechacadu; ?>" required>
                                </td>
                            </tr>
                            <?php if (isset($_GET['id'])) { ?>
                                <tr>
                                    <td>Activo</td>
                                    <td>
                                        <input type="radio" name="activo" value="1"  <?php echo estado_check(1, $estado_actividad) ?>> Activo                        
                                        <input type="radio" name="activo" value="0" <?php echo estado_check(0, $estado_actividad) ?>>Inactivo
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="2">
                                    <input class="btn btn-success" type="submit" name="submit" value="Aceptar">
                                    <a href="LISTAP.PHP">Lista de Productos</a></td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>

    </body>
</html>
