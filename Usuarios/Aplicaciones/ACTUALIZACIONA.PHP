<?php require_once ("../../Includes/SESSION.php");?>
<?php require_once ("../../Includes/CONEXION.php");?>
<?php require_once ("../../Includes/FUNCIONES.php");?>

<?php
if (isset($_GET['id'])) 
{
   
    $nombreProducto = $_POST['nombreprod'];
    $nombrePlanta = $_POST['nombreplanta'];    
    $tratamiento = $_POST['tratamiento'];
    $cantidad = $_POST['cantidad'];
    $fechaAplicacion = $_POST['fechaAplicacion'];
    $proximaAplicacion = $_POST['proximaAplicacion'];    

    global $var_mysqli;
    $query = "update aplicacion set id_planta=?,id_producto=?,tipotratamiento=?,cant_aplicada=?,fecha_aplicacion=?,fecha_prox=? where id_aplicacion=?;";
    if (!$sentencia = $var_mysqli -> prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> bind_param("iisissi",$nombrePlanta,$nombreProducto, $tratamiento, $cantidad, $fechaAplicacion,$proximaAplicacion,$_GET['id'])) {
        echo "Falló la vinculación de parámetros: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }
    if (!$sentencia -> execute()) {
        echo "Falló la ejecución: (" . $sentencia -> errno . ") " . $sentencia -> error;
    }     
 } 
 header('Location: LISTAA.PHP');
?>