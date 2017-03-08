<?php require_once ("../conexion.php");         ?>
<?php require_once ("../funciones.php"); ?>

<?php  

$quimico= productos_quimico();


print json_encode($quimico);




?>