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
$m_tipos_productos = "";
$nombreProd = "";
$nombrePlant = "";
$tratamiento = "";
$cantAplicada = "";
$fechaAplicacion = "";
$fechaProx = "";
$siguiente_pagina = "LISTAA.PHP";
$lista_productos;
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACIONA.PHP?id=" . $_GET['id'];
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body  ng-controller="PlantaCtrl">
        <?php echo $cabezera; ?>
        <?php
        if (isset($_GET['id'])) {
            if ($aplicacion_buscada != NULL) {
                echo '{{agregar_p(' . $id_producto . ')}}';
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
                                    <div >
                                        <select ng-model="m_tipos_productos"  ng-change="cambiar_t_p()"  ng-options="tipo_producto.id  as tipo_producto.nombre for tipo_producto in tipos_productos">
                                            <option value="">- Seleccione -</option>
                                        </select>
                                    </div><div class="form-group">
                                    </div></td>
                            </tr>
                            <tr>
                                <td>Producto:</td>
                                <td>

                                    <select name="nombreprod" id="nombreprod"    ng-options="producto  as producto.nombre_com for producto in productos track by producto.id_producto"
                                            ng-model="selectedOption"> 
                                        <option value="{{selectedOption.id_producto}}">{{selectedOption.nombre_com}}</option>
                                        <option value="">- Seleccione -</option>

                                    </select>  

                                </td>
                            </tr>
                            <tr>
                                <td>Plantas:</td>
                                <td>
                                    <select name="nombreplanta">
                                        <?php foreach ($plantas as $planta) { ?>
                                            <option value="<?php echo $planta['cod_planta']; ?> "><?php echo $planta['nomb_planta']; ?></option>
                                        <?php } ?>
                                    </select></td>
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
                                <td>Cantidad Aplicada:</td>
                                <td>
                                    <input type="text" name="cantidad" maxlength="20" value="<?php echo $cantAplicada; ?>" required>
                                </td>
                            </tr>
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
                                    <a href="LISTAA.PHP">Registro de Aplicaciones</a></td>


                            </tr>
                        </table>
                    </form>
                </div>

            </div>
        </div>

    </body>
</html>
