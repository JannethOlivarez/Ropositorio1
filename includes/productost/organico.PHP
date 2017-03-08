<?php require_once ("../conexion.php");         ?>
<?php require_once ("../funciones.php"); ?>

<?php  


$organico=productos_organico();

print json_encode($organico);



?>