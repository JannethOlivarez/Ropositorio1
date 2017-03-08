
<?php require_once ("../../includes/conexion.php");?>
<?php require_once ("../../includes/funciones.php");?>

<?php
if (isset($_GET['id'])) 
{

    $fechaSiembra = $_POST['fechaSiembra'];
    $cantidadplantas = $_POST['cantidadplantas'];    
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update vinculacion set fecha_siembra=?,cant_plantas=? where id_vinculacion=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("sii", $fechaSiembra, $cantidadplantas,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: listav.PHP');
?>
