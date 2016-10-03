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
        // Iniciar procesamiento de formulario

        if (isset($_POST['submit'])) {// sI ESQ HIZO CLICK.
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];
            if (logged_in()) {
                print_r($_SESSION);
                $var_mensaje = Login($usuario, $contrasena);
            } else {
                header('Location:MENU.php');
            }
        }
        ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script scr="js/jquery.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<!-- Optional theme -->
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	</head>
	<body>
	    
        <img class="pequeña" src="../Imagenes/imagen1.png"/>
		<div  class="container">
			<h1>Identifíquese!!</h1>
			<form action="LOGIN.php" method="post" >
				<table>
					<tr>
						<td>Usuario:</td>
						<td>
						<input type="text" name="usuario" maxlength="30" value="" required="true" autocomplete="off" />
						</td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td>
						<input type="password" name="contrasena" maxlength="30" value="" required="true" />
						</td>
					</tr>
					<?php echo $var_mensaje; ?>
					<tr>
						<td colspan="2">
						<input class="btn" type="submit" name="submit" value="Acceder" />
						</td>
					</tr>
				</table>
			</form>
		</div>

		<?php
        mysqli_close($var_mysqli);
		?>
	</body>
</html>

