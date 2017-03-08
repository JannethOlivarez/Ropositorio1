

<?php require_once ("../../includes/conexion.php");?>
<?php require_once ("../../includes/funciones.php");?>

<?php
if (isset($_GET['id'])) 
{
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $variedad = $_POST['variedad'];
    $procedencia = $_POST['procedencia'];     
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update plantas set nomb_planta=?,especie=?,variedad=?,lugar_Procedencia=? where cod_planta=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("ssssi", $nombre, $especie, $variedad, $procedencia,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: lista.PHP');
?>
