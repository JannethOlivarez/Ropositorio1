

<?php require_once ("../../includes/conexion.php"); ?>
<?php require_once ("../../includes/funciones.php"); ?>
<?php
require_once ("../../includes/diseno/cabezera.php");
?>

<?php
$var_mensaje = "";
if (isset($_POST['submit'])) {
    $planta = $_POST['planta'];

    $fechaSiembra = $_POST['fechaSiembra'];
    $cantidadplantas = $_POST['cantidadplantas'];
    if (logged_in()) {
        $var_mensaje = Vinculacion($planta, $fechaSiembra, $cantidadplantas);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}

function edad($año, $mes, $dias) {
    $edad = "";
    if ($año != 0) {
        if ($año == 1) {
            $edad .= "1 año ";
        } else {
            $edad .= $año." años ";
        }
    }
    if ($mes != 0) {
        if ($mes == 1) {
            $edad .= "1 mes ";
        } else {
            $edad .= $mes." meses ";
        }
    }
    if ($dias != 0) {
        if ($dias == 1) {
            $edad .= "1 dìa ";
        } else {
            $edad .= $dias." dìas ";
        }
    }
    return $edad;
}

$registros = obtener_todas_vinculaciones();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     

    </head>
    <body>
        <div class="row">
<?php echo $cabezera; ?>

            <title>Vinculacion de plantas y lotes</title>	
            <div class="container ">
                <a href="ingresov.PHP">Agregar nueva Siembra</a>
                <div class="table-responsive">
                    <table  class="table table-striped">
                        <thead class="thead-default">
                            <tr >
                                <th >PLANTA</th>    
                                <th>LOTE Nº</th>    
                                <th>FECHA DE SIEMBRA</th>
                                <th>CANTIDAD DE PLANTAS</th> 
                                <th>EDAD</th> 
                            </tr>   
                        </thead>
<?php foreach ($registros as $reg) { ?>  
                            <tr>
                                <td><?php echo $reg['nomb_planta']; ?></td>  
                                <td><?php echo $reg['num_lote']; ?></td>    
                                <td><?php echo $reg['fecha_siembra']; ?></td>
                                <td><?php echo $reg['cant_plantas']; ?></td> 
                                <td>
                                    <?php
                                    $date1 = new DateTime("now");
                                    $date2 = new DateTime($reg['fecha_siembra']);
                                    $interval = date_diff($date1, $date2);
                                    
                                   echo edad($interval->format('%y'), $interval->format('%m'), $interval->format('%d'));
                                    ?>
                                </td>
                                <td><a href="ingresov.PHP?id=<?php echo $reg['id_vinculacion']; ?>">Actualizar</a></td>
                                <td><a href="etiqueta.PHP?id=<?php echo $reg['id_vinculacion']; ?>">Generar Etiquetas</a></td>   
                            </tr>
                            <?php
                        }
                        ?>
                    </table>                 		    		    		    		



                </div>

            </div>

        </div>        
    </body>
</html>
