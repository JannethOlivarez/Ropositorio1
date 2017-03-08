

<?php require_once ("../../includes/conexion.php");?>
<?php require_once ("../../includes/funciones.php");?>

<?php
if (isset($_GET['id'])) 
{
 
    $estado = $_POST['estado'];   
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update lotes set estado=? where cod_lote=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("si", $estado,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: listal.PHP');
?>
