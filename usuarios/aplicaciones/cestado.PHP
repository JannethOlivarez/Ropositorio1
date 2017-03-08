<?php
require_once ("../../includes/conexion.php");
require_once ("../../includes/funciones.php");
require_once ("../../includes/diseno/cabezera.php");
$reagendar = "";
if (isset($_GET['reagendar'])) {
    $reagendar = "&reagendar=si";
}
if (isset($_GET['id']) && isset($_GET['completar']) && !isset($_POST['submit'])) {
    $query = "update aplicacion set efectuada=1 where id_aplicacion=?;";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    Redireccionar("listaa.PHP");
} else {

    if (isset($_GET['id'])) {

        $aplicacion_buscada = obtener_aplicacion_por_id($_GET['id']);
        $lista_productos = productos_organico();
        if ($aplicacion_buscada != NULL) {
            $nombreProd = $aplicacion_buscada[0]['nombre_com'];
            $id_vinculacion = $aplicacion_buscada[0]['id_vinculacion'];
            $id_producto = $aplicacion_buscada[0]['id_producto'];
            $nombrePlant = $aplicacion_buscada[0]['nomb_planta'];
            $tratamiento = $aplicacion_buscada[0]['tipotratamiento'];
            $cantAplicada = $aplicacion_buscada[0]['cant_aplicada'];
            $fechaAplicacion = $aplicacion_buscada[0]['fecha_aplicacion'];
            $fechaProx = $aplicacion_buscada[0]['fecha_prox'];
            $numLote = $aplicacion_buscada[0]['num_lote'];
            $estado_sl = $aplicacion_buscada[0]['estado_sl'];
        }
    }
    if (isset($_POST['submit']) && !isset($_GET['reagendar'])) {

        $proximaAplicacion = $_POST['proximaAplicacion'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $tipo_sl = $estado_sl;
        $var_mensaje = Aplicacion($id_vinculacion, $id_producto, $tratamiento, $cantidad, $fechaProx, $proximaAplicacion, $unidad, $tipo_sl);
        $query = "update aplicacion set efectuada=1 where id_aplicacion=?;";
        if (!$sentencia = $var_mysqli->prepare($query)) {
            echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
        }
        if (!$sentencia->bind_param("i", $_GET['id'])) {
            echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
        }
        if (!$sentencia->execute()) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }
        Redireccionar("listaa.PHP");
    } else if (isset($_POST['submit']) && isset($_GET['reagendar'])) {
        $proximaAplicacion = $_POST['proximaAplicacion'];
        $cantidad = $_POST['cantidad'];
        $unidad = $_POST['unidad'];
        $tipo_sl = $estado_sl;
        $motivo = $_POST['motivo'];
        $var_mensaje = Reagendar($motivo, $_GET['id'], $cantidad, $fechaProx, $proximaAplicacion, $unidad, $tipo_sl);

        Redireccionar("listaa.PHP");
    }
}
?>
<script src="../../js/angular.min.js"></script>
<script src="../../js/miangular.js"></script>
<!DOCTYPE html>
<html ng-app="App">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/estilos.css">   
        <script scr="js/jquery.js"></script>
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

                    <form action="cestado.PHP?completar=si&id=<?php echo $_GET['id'] . $reagendar; ?>" method="post">
                        <table>

                            <tr>
                                <td>Producto:</td>
                                <td>
                                    <?php echo $nombreProd; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Lote</td>
                                <td>
                                    <?php echo $numLote; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Planta:</td>
                                <td>
                                    <?php echo $nombrePlant; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tipo de Tratamiento:</td>
                                <td>
                                    <?php echo $tratamiento; ?>
                                </td>
                            </tr>
                            <tr>
                                <td >Cantidad Aplicada:</td>

                                <td>
                                    <input type="number" ng-model="cantidad" ng-blur="validar_cantidad()" name="cantidad" maxlength="20" value="<?php echo $cantAplicada; ?>" required>
                                    <br>{{mensajecantidad}}
                                </td>
                                <td>
                                    <?php echo "{{cambiar_unidades_php(" . $estado_sl . ")}}"; ?>
                                    <input type="hidden" name="estado_sl" value="{{selectedOption.estado_sl}}">
                                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades track by unidad.id"
                                            ng-model="unidad_sel" required > 
                                    </select>  <br>

                                </td>


                            </tr>
                            <tr> <td></td><td>Cantidad Actual:{{selectedOption.cantidad_prod * unidad_sel.conversion}} {{unidad_sel.label}}</td></tr>
                            <tr>
                                <td>Fecha de Aplicacion:</td>
                                <td> 
                                    <?php
                                    if (!isset($_GET['reagendar'])) {
                                        echo $fechaProx;
                                    } else {
                                        echo $fechaAplicacion;
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Proxima Aplicacion:</td>
                                <td>
                                    <input type="date" name="proximaAplicacion" maxlength="20" value="" required>
                                </td>
                            </tr>
                            <?php if (isset($_GET['reagendar'])) { ?>
                                <tr>
                                    <td>Motivo Reagendamiento:</td>
                                    <td>
                                        <textarea rows="4" cols="50" required name="motivo">
                                                
                                        </textarea>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="2">
                                    <input class="btn btn-success" type="submit" name="submit" value="Aceptar">
                                    <a href="listaa.PHP">Registro de Aplicaciones</a></td>


                            </tr>
                        </table>
                    </form>
                </div>

            </div>
             <script src="../../js/jquery.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
        </div>

    </body>
</html>