
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
<script src="../../js/angularunidades.js"></script>
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
    $siguiente_pagina = "actualizacionp.PHP?id=" . $_GET['id'];
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
<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     

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
                                    <a href="listap.PHP">Lista de Productos</a></td>
                            </tr>
                        </table>
                    </form>
                </div>

            </div>
  
            
            </div>
    </body>
</html>
