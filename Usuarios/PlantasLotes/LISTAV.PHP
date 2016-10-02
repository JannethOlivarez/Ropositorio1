<?php require_once ("../../Includes/SESSION.php"); ?>
<?php require_once ("../../Includes/CONEXION.php"); ?>
<?php require_once ("../../Includes/FUNCIONES.php"); ?>
<?php
require_once ("../../Includes/Diseno/CABEZERA.php");
?>
<?php
require_once ("../../Includes/Diseno/CABEZERA.php");
?>

<?php
$var_mensaje = "";
if (isset($_POST['submit'])) {
    $planta = $_POST['planta'];
    $lote = $_POST['lote'];
    $fechaSiembra = $_POST['fechaSiembra'];
    $cantidadplantas = $_POST['cantidadplantas'];
    if (logged_in()) {
        $var_mensaje = Vinculacion($planta, $lote, $fechaSiembra, $cantidadplantas);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}
$registros = RegistroVinculacion();
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

            <title>Vinculacion de plantas y lotes</title>	
            <div class="container ">
                <a href="INGRESOV.PHP">Agregar nueva Siembra</a>
                <table  class="table table-striped">
                    <thead class="thead-default">
                        <tr >
                            <th >PLANTA</th>    
                            <th>LOTE Nº</th>    
                            <th>FECHA DE SIEMBRA</th>
                            <th>CANTIDAD DE PLANTAS</th>   
                        </tr>   
                    </thead>
                    <?php foreach ($registros as $reg) { ?>  
                        <tr>
                            <td><?php echo $reg['nomb_planta']; ?></td>  
                            <td><?php echo $reg['num_lote']; ?></td>    
                            <td><?php echo $reg['fecha_siembra']; ?></td>
                            <td><?php echo $reg['cant_plantas']; ?></td> 
                            <td><a href="INGRESOV.PHP?id=<?php echo $reg['id_vinculacion']; ?>">Actualizar</a></td>
                            <td><a href="ETIQUETA.PHP?id=<?php echo $reg['id_vinculacion']; ?>">Generar Etiquetas</a></td>   
                        </tr>
                        <?php
                    }
                    ?>
                </table>                 		    		    		    		
            </div>
    </body>
</html>
