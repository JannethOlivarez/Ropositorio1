
<?php require_once ("../../includes/conexion.php"); ?>
<?php require_once ("../../includes/funciones.php"); ?>


<?php

if (isset($_GET['id'])) {

    $nombreProducto = $_POST['nombreprod'];
    $nombrePlanta = $_POST['nombreplanta'];
    $tratamiento = $_POST['tratamiento'];
    $cantidadp = $_POST['cantidad'];
    $fechaAplicacion = $_POST['fechaAplicacion'];
    $proximaAplicacion = $_POST['proximaAplicacion'];
    $unidad = $_POST['unidad'];
    $tipo_sl = $_POST['estado_sl'];
    if ($unidad != 4) {
        if (strcmp("liquido", $tipo_sl) == 0) {
            switch ($unidad) {
                case 1:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.01;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.1;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 3.7854;
                    break;
                default:
                    $cantidadp = $cantidadp;
                    break;
            }
        } else {
            switch ($unidad) {
                case 0:
                    $cantidadp = $cantidadp * 0.000001;
                    break;

                case 1:
                    $cantidadp = $cantidadp * 0.00001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.0001;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 0.0283495;
                    break;
                case 6:
                    $cantidadp = $cantidadp * 0.453592;
                    break;
                case 7:
                    $cantidadp = $cantidadp * 100;
                    break;
                default:
                    break;
            }
        }
    }
    $aplicacion_buscada = obtener_aplicacion_por_id($_GET['id']);
    if ($aplicacion_buscada != NULL) {
        $id_producto = $aplicacion_buscada[0]['id_producto'];
        $cantAplicada = $aplicacion_buscada[0]['cant_aplicada'];
    }
    global $var_mysqli;


    if ($id_producto == $nombreProducto) {
        if ($cantidadp != $cantAplicada) {
            echo $cantidadp;
            echo $cantAplicada;
            if ($cantidadp > $cantAplicada) {
                actualizar_cantidad_producto("-", $cantidadp - $cantAplicada, $nombreProducto);
            } else {
                actualizar_cantidad_producto("+",$cantAplicada-$cantidadp,$nombreProducto);
            }
           
        }
    } else {
        actualizar_cantidad_producto("+",$cantAplicada,$id_producto);
        actualizar_cantidad_producto("-",$cantidadp,$nombreProducto);
    }
        $query = "update aplicacion set id_vinculacion=?,id_producto=?,tipotratamiento=?,cant_aplicada=?,fecha_aplicacion=?,fecha_prox=? where id_aplicacion=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("iisdssi",$nombrePlanta,$nombreProducto, $tratamiento, $cantidadp, $fechaAplicacion,$proximaAplicacion,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }  
}

function actualizar_cantidad_producto($suma_resta, $cantidadp, $nombreProducto) {
    global $var_mysqli;
//update cantidad producto
    $query = "update productos set cantidad_prod=cantidad_prod " . $suma_resta . "? where id_producto=?;";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("di", $cantidadp, $nombreProducto)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

header('Location: listaa.PHP');
?>