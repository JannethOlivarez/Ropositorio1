
<?php require_once ("../../includes/conexion.php");?>
<?php require_once ("../../includes/funciones.php");?>

<?php
if (isset($_GET['id'])) 
{
   
    $unidad = $_POST['unidad'];
    $tipo_sl = $_POST['tipo_sl'];
    $cantidadp = $_POST['cantidadp'];
     if ($unidad != 4) {
            if (strcmp("L", $tipo_sl) == 0) {
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
    global $var_mysqli;
    $query = "update productos set cantidad_prod=cantidad_prod +? where id_producto=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("di",$cantidadp,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: listap.PHP');
?>
