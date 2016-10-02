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
$tipo = "";
$nombrec = "";
$principioa = "";
$cantidadp = "";
$fechaelab = "";
$fechacadu = "";
$siguiente_pagina = "LISTAP.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACIONP.PHP?id=" . $_GET['id'];
    $producto_buscado = obtener_producto_por_id($_GET['id']);
    if ($producto_buscado != NULL) {
        $tipo = $producto_buscado[0]['tipo_producto'];
        $nombrec = $producto_buscado[0]['nombre_com'];
        $principioa = $producto_buscado[0]['principio_activo'];
        $cantidadp = $producto_buscado[0]['cantidad_prod'];
        $fechaelab = $producto_buscado[0]['fecha_elab'];
        $fechacadu = $producto_buscado[0]['fecha_cadu'];
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
                <div id="contenido Productos">
            <h2>Ingrese los datos del nuevo producto:</h2>
            <form action="<?php echo $siguiente_pagina; ?>" method="post">
                <table>
                    <tr>
                        <td>Tipo de Producto:</td>
                        <td>                        
                        <input type="radio" name="tipo" value="Orgánico" required > Orgánico                        
                        <input type="radio" name="tipo" value="Químico">Químico
                        <br>
            
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre Comercial:</td>
                        <td>
                        <input type="text" name="nombrec" maxlength="20" value="<?php echo $nombrec; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Principio Activo:</td>
                        <td>
                        <input type="text" name="principioa" maxlength="25" value="<?php echo $principioa; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Cantidad Total de Producto:</td>
                        <td>
                        <input type="text" name="cantidadp" maxlength="10" value="<?php echo $cantidadp; ?>" required>
                        </td>
                                    <td>
                            <select name="unidad">
                            <option value="uni">cm3</option>
                            <option value="uni">ml3</option>
                            <option value="uni">l</option>
                            <option value="uni">cm3</option>
                            </select></td>                 
                    </tr>                          
                    <tr>
                        <td>Fecha de Elaboración:</td>
                        <td>
                         <input type="date" name="fechaelab" value="<?php echo $fechaelab; ?>"required>
        
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha de Vencimiento:</td>
                        <td>
                        <input type="date" name="fechacadu"  value="<?php echo $fechacadu; ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input class="btn btn-success" type="submit" name="submit" value="Aceptar">
                        <a href="LISTAP.PHP">Lista de Productos</a></td>
                    </tr>
                </table>
            </form>
        </div>
                
            </div>
		
	</body>
</html>
