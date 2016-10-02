<?php require_once ("../CONEXION.php");         ?>
<?php require_once ("../FUNCIONES.php"); ?>

<?php  

$quimico= productos_quimico();


print json_encode($quimico);




?>