<?php require_once ("../../Includes/SESSION.php");?>
<?php require_once ("../../Includes/CONEXION.php");?>
<?php require_once ("../../Includes/FUNCIONES.php");?>

<?php
if (isset($_GET['id'])) 
{
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $variedad = $_POST['variedad'];
    $procedencia = $_POST['procedencia']; 
    $identi=$_POST['identi'];
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update plantas set nomb_planta=?,especie=?,variedad=?,lugar_Procedencia=?,identificativo=? where cod_planta=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("sssssi", $nombre, $especie, $variedad, $procedencia,$identi,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: LISTA.PHP');
?>
