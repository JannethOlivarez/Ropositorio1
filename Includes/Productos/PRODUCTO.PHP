<?php require_once ("../CONEXION.php");         ?>
<?php require_once ("../FUNCIONES.php"); ?>

<?php  


$producto=obtener_producto_por_id($_GET['id']);

print json_encode($producto[0]);



?>