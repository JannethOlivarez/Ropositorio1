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
$m_tipos_productos = "";
$nombreProd = "";
$nombrePlant = "";
$tratamiento = "";
$cantAplicada = "";
$fechaAplicacion = "";
$fechaProx = "";
$id_lote="";
$aplicacion_buscada="";
$siguiente_pagina = "listaa.PHP";
$lista_productos;
if (isset($_GET['id'])) {
    $siguiente_pagina = "actualizaciona.PHP?id=" . $_GET['id'];
    $aplicacion_buscada = obtener_aplicacion_por_id($_GET['id']);
    $lista_productos = productos_organico();
    if ($aplicacion_buscada != NULL) {
        $nombreProd = $aplicacion_buscada[0]['nombre_com'];
        $id_planta = $aplicacion_buscada[0]['id_planta'];
        $id_producto = $aplicacion_buscada[0]['id_producto'];
        $nombrePlant = $aplicacion_buscada[0]['nomb_planta'];
        $tratamiento = $aplicacion_buscada[0]['tipotratamiento'];
        $cantAplicada = $aplicacion_buscada[0]['cant_aplicada'];
        $fechaAplicacion = $aplicacion_buscada[0]['fecha_aplicacion'];
        $fechaProx = $aplicacion_buscada[0]['fecha_prox'];
        $id_lote = $aplicacion_buscada[0]['id_lote'];
         $estado_sl= $aplicacion_buscada[0]['estado_sl'];
         $id_vinculacion=$aplicacion_buscada[0]['id_vinculacion'];
        if (strcasecmp($aplicacion_buscada[0]['tipo_producto'], 'Organico')) {
            $lista_productos = productos_organico();
        } else {
            $lista_productos = productos_quimico();
        }
    }
}
$productos = optener_todos_productos();
$plantas = obtener_todas_plantas();
?>
<script src="../../js/angular.min.js"></script>
<script src="../../js/miangular.js"></script>
<!DOCTYPE html>
<html ng-app="App">
    <head>
     
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     
       
    </head>
    <body  ng-controller="PlantaCtrl">
        <?php echo $cabezera; ?>
        <?php
        
        if (isset($_GET['id'])) {
            if ($aplicacion_buscada != NULL) {
                echo '{{agregar_p(' . $id_producto . ','.$cantAplicada.')}}';
                echo '{{agregar_lote_planta(' . $id_vinculacion . ','.$id_planta.')}}';
            }
        }
        ?>

        <div class="row">
            <div class="container">
                <div id="contenido Plantas">
                    <h2>Ingrese los datos de la nueva Aplicación</h2>
            
                    <form action="<?php echo $siguiente_pagina; ?>" method="post">
                        <table>
                            <tr>
                                <td>Tipo de Producto</td>
                                <td>
                                 
                                        <select ng-model="m_tipos_productos"  ng-change="cambiar_t_p()"  ng-options="tipo_producto.id  as tipo_producto.nombre for tipo_producto in tipos_productos">
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </td>
                            </tr>
                            <tr>
                                <td>Producto:</td>
                                <td>

                                    <select name="nombreprod" id="nombreprod"    ng-options="producto  as producto.nombre_com for producto in productos track by producto.id_producto"
                                            ng-model="selectedOption" ng-change="cambiar_unidades()"> 
                                        <option value="{{selectedOption.id_producto}}">{{selectedOption.nombre_com}}</option>
                                        <option value="">- Seleccione -</option>

                                    </select>  
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>Plantas:</td>
                                <td>
                                      
                                    <select  ng-change="cambiar_lotes()"  ng-model="planta_sel"  ng-options="plantai.cod_planta  as plantai.nomb_planta for plantai in plantas track by plantai.cod_planta">
                                            <option value="">- Seleccione -</option>
                                     </select>
                                </td>
                              
                            </tr>
                           
                            <tr>
                                <td>Lote</td>
                                <td>
                                     <select name="nombreplanta" ng-model="m_lote"    ng-options="lote.id_vinculacion  as lote.num_lote for lote in lotes track by lote.id_vinculacion">
                                            <option value="">- Seleccione -</option>
                                     </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Tipo de Tratamiento:</td>
                                <td>
                                    <select name="tratamiento">
                                        <option value="Fertilizaciòn" <?php echo $tratamiento; ?>>Fertilizaciòn</option>
                                        <option value="Plaga">Plaga</option>
                                        <option value="Enfermedad" selected>Enfermedad</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td >Cantidad Aplicada:</td>
                               
                                <td>
                                    <input type="number" ng-model="cantidad" step="any" ng-blur="validar_cantidad()" name="cantidad" maxlength="20" value="<?php echo $cantAplicada; ?>" required>
                                    <br>{{mensajecantidad}}
                                </td>
                                <td>
                                    <input type="hidden" name="estado_sl" value="{{selectedOption.estado_sl}}">
                                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades track by unidad.id"
                                            ng-model="unidad_sel" required > 
                                    </select>  <br>
                                    
                                </td>
                               
                              
                            </tr>
                            <tr> <td></td><td>Cantidad Actual:{{selectedOption.cantidad_prod*unidad_sel.conversion}} {{unidad_sel.label}}</td></tr>
                            <tr>
                                <td>Fecha de Aplicacion:</td>
                                <td>
                                    <input type="date" name="fechaAplicacion" value="<?php echo $fechaAplicacion; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Proxima Aplicacion:</td>
                                <td>
                                    <input type="date" name="proximaAplicacion" maxlength="20" value="<?php echo $fechaProx; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="btn btn-success" type="submit" name="submit" value="Aceptar">
                                    <a href="listaa.PHP">Registro de Aplicaciones</a></td>


                            </tr>
                        </table>
                    </form>
                </div>

            </div>
 
        </div>

    </body>
</html>
