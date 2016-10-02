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
    $tipo = $_POST['tipo'];
    $nombrec = $_POST['nombrec'];
    $principioa = $_POST['principioa'];
    $cantidadp = $_POST['cantidadp'];
    $fechaelab = $_POST['fechaelab'];
    $fechacadu = $_POST['fechacadu'];
    $unidad= $_POST['unidad']; 
    $tipo_sl= $_POST['unidad']; 
    if (logged_in()) {
        echo $unidad;
        echo $unidad;
        echo $tipo_sl;
        //$var_mensaje = Productos($tipo, $nombrec, $principioa, $cantidadp, $fechaelab, $fechacadu);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
        
    }
}
$registros = optener_todos_productos_quimicos();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <title>Productos </title> 
    </head>
    <body>
        <div class="row">
            <?php echo $cabezera; ?>


            <div class="container">
                <h1>Productos Quìmicos</h1>
                <table  class="table table-striped">
                    <thead class="thead-default">
                        <tr >
                          
                            <th>PRODUCTO</th>    
                            <th>PRINCIPIO ACTIVO</th>
                            <th>CANTIDAD TOTAL</th>
                            <th>FECHA ELABORACIÒN</th>  
                            <th>FECHA VENCIMINETO</th>
                            <th>ACTIVO</th>
                        </tr>   
                    </thead>
                    <?php foreach ($registros as $reg) { ?>  
                        <tr>
                          
                            <td><?php echo $reg['nombre_com']; ?></td>  
                            <td><?php echo $reg['principio_activo']; ?></td>  
                            <td><?php echo $reg['cantidad_prod']; ?></td>  
                            <td><?php echo $reg['fecha_elab']; ?></td>    
                            <td><?php echo $reg['fecha_cadu']; ?></td>
                            <td><?php echo estado($reg['estado_actividad']) ?></td>
                            <td><a href="INGRESOP.PHP?id=<?php echo $reg['id_producto']; ?>">Actualizar</a></td>  
                            <?php
                        }
                        ?>
                        </div>

                        <!DOCTYPE html>


                </table>
                <h1>Productos Orgànicos</h1>
                <table  class="table table-striped">
                    <thead class="thead-default">
                        <tr >
                             
                            <th>PRODUCTO</th>    
                            <th>PRINCIPIO ACTIVO</th>
                            <th>CANTIDAD TOTAL</th>
                            <th>FECHA ELABORACIÒN</th>  
                            <th>FECHA VENCIMINETO</th>
                            <th>ACTIVO</th>
                        </tr>   
                    </thead>
                    <?php foreach ($registros as $reg) { ?>  
                        <tr>
                        
                            <td><?php echo $reg['nombre_com']; ?></td>  
                            <td><?php echo $reg['principio_activo']; ?></td>  
                            <td><?php echo $reg['cantidad_prod']; ?></td>  
                            <td><?php echo $reg['fecha_elab']; ?></td>    
                            <td><?php echo $reg['fecha_cadu']; ?></td>
                            <td><?php echo estado($reg['estado_actividad']) ?></td>
                            <td><a href="INGRESOP.PHP?id=<?php echo $reg['id_producto']; ?>">Actualizar</a></td>  
                            <?php
                        }
                        ?>
                        </div>

                        <!DOCTYPE html>


                </table>
                <a href="INGRESOP.PHP">Nueva</a>				
                </body>
                </html>
