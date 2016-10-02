<?php require_once ("../../Includes/SESSION.php");?>
<?php require_once ("../../Includes/CONEXION.php");?>
<?php require_once ("../../Includes/FUNCIONES.php");?>

<?php
if (isset($_GET['id'])) 
{
    $planta = $_POST['planta'];
    $lote = $_POST['lote'];
    $fechaSiembra = $_POST['fechaSiembra'];
    $cantidadplantas = $_POST['cantidadplantas'];    
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update vinculacion set id_planta=?,id_lote=?,fecha_siembra=?,cant_plantas=? where id_vinculacion=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("iisii", $planta, $lote, $fechaSiembra, $cantidadplantas,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: LISTAV.PHP');
?>
