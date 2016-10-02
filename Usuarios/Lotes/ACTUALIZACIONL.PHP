<?php require_once ("../../Includes/SESSION.php");?>
<?php require_once ("../../Includes/CONEXION.php");?>
<?php require_once ("../../Includes/FUNCIONES.php");?>

<?php
if (isset($_GET['id'])) 
{
    $numLote = $_POST['num_lote'];
    $estado = $_POST['estado'];   
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update lotes set num_lote=?,estado=? where cod_lote=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("isi", $numLote,$estado,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: LISTAL.PHP');
?>
