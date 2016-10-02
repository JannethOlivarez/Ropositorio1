<?php require_once ("../../Includes/SESSION.php");?>
<?php require_once ("../../Includes/CONEXION.php");?>
<?php require_once ("../../Includes/FUNCIONES.php");?>

<?php
if (isset($_GET['id'])) 
{
    $tipo = $_POST['tipo'];
    $nombrec = $_POST['nombrec'];    
    $principioa = $_POST['principioa'];
    $cantidadp = $_POST['cantidadp'];
    $fechaelab = $_POST['fechaelab'];
    $fechacadu = $_POST['fechacadu'];
    $activo = $_POST['activo'];
    print_r($_POST);
    print_r($_GET);
    global $var_mysqli;
    $query = "update productos set tipo_producto=?,nombre_com=?,principio_activo=?,cantidad_prod=?,fecha_elab=?,fecha_cadu=?,estado_actividad=? where id_producto=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("sssissii",$tipo,$nombrec,$principioa,$cantidadp,$fechaelab,$fechacadu,$activo,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: LISTAP.PHP');
?>
