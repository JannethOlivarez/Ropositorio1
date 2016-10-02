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
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $variedad = $_POST['variedad'];
    $procedencia = $_POST['procedencia'];
    $identi = $_POST['identi'];
    if (logged_in()) {
        $var_mensaje = Plantas($nombre, $especie, $variedad, $procedencia, $identi);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}
$registros = obtener_todas_plantas();
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
        </div>
        <title>Plantas no tradicionales</title>	

        <div class="container">
<a href="INGRESO.PHP">Agregar nueva Planta</a>
            <table  class="table table-striped">
                <thead class="thead-default">
                    <tr>
                        <th>NOMBRE</th>    
                        <th>ESPECIE</th>    
                        <th>VARIEDAD</th>
                        <th>PROCEDENCIA</th>   
                        <th>IDENTIFICATIVO</th>  
                    </tr>   
                </thead>
                <?php foreach ($registros as $reg) { ?>  
                    <tr>
                        <td><?php echo $reg['nomb_planta']; ?></td>  
                        <td><?php echo $reg['especie']; ?></td>    
                        <td><?php echo $reg['variedad']; ?></td>
                        <td><?php echo $reg['lugar_Procedencia']; ?></td> 
                        <td><?php echo $reg['identificativo']; ?></td> 
                        <td><a href="INGRESO.PHP?id=<?php echo $reg['cod_planta']; ?>">Actualizar</a></td>  
                        <?php
                    }
                    ?>
            </table>



        </div>
			
    </body>
</html>
