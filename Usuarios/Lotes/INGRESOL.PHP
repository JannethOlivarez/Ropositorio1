<?php
require_once ("../../Includes/SESSION.php");
?>
<?php
require_once ("../../Includes/CONEXION.php");
?>
<?php
require_once ("../../Includes/FUNCIONES.php");
?>
<?php
require_once ("../../Includes/Diseno/CABEZERA.php");
?>

<?php
$var_mensaje = "";
$num_lote = "";
$estado = "";
$siguiente_pagina = "LISTAL.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACIONL.PHP?id=" . $_GET['id'];
    $lote_buscado = obtener_Lote_por_id($_GET['id']);
    if ($lote_buscado != NULL) {
        $num_lote = $lote_buscado[0]['num_lote'];
        $estado = $lote_buscado[0]['estado'];
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script scr="js/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>
	<body>
		<div class="row">
		 <?php echo $cabezera; ?>
			<div class="container">
				<div id="contenido Plantas">
					<h2>Datos de  Nuevo Lote:</h2>
					<form action="<?php echo $siguiente_pagina; ?>" method="post">
						<table>
							<tr>
								<td>Número:</td>
								<td>
								<input type="text" name="num_lote" maxlength="20" value="<?php echo $num_lote; ?>" required>
								</td>
							</tr>
							<tr>
								<td>Estado:</td>
								
							<td>
                            <select name="estado">                         
                                <option value="activo">activo</option>      
                                <option value="inactivo">inactivo</option>                           
                            </select></td>
				
							</tr>

							<tr>
								<td colspan="2">
								<input class="btn btn-success" type="submit" name="submit" value="Aceptar">
								<a href="LISTAL.PHP">Lista de Lotes</a></td>
							</tr>
						</table>
					</form>
				</div>

			</div>

	</body>
</html>