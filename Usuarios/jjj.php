<?php
require_once ("../Includes/SESSION.php");
?>
<?php
require_once ("../Includes/CONEXION.php");
?>
<?php
require_once ("../Includes/FUNCIONES.php");
?>

<?php
$var_mensaje = "";
$nombre = "";
$especie = "";
$variedad = "";
$procedencia = "";
$siguiente_pagina = "LISTA.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACION.PHP?id=" . $_GET['id'];
    $planta_buscada = obtener_planta_por_id($_GET['id']);
    if ($planta_buscada != NULL) {
        $nombre = $planta_buscada[0]['nomb_planta'];
        $especie = $planta_buscada[0]['especie'];
        $variedad = $planta_buscada[0]['variedad'];
        $procedencia = $planta_buscada[0]['lugar_Procedencia'];
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script scr="js/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	</head>
	<body>
            <input  type="date" name="fecha">
            <?php echo date("m/d/Y"); ?>" size="10" />

	</body>
</html>