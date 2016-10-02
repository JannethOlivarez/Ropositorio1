<?php require_once ("../CONEXION.php");         ?>
<?php require_once ("../FUNCIONES.php"); ?>

<?php  


$organico=productos_organico();

print json_encode($organico);



?>