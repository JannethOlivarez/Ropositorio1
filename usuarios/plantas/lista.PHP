

<?php
require_once ("../../includes/conexion.php");
?>
<?php
require_once ("../../includes/funciones.php");
?>
<?php
require_once ("../../includes/diseno/cabezera.php");
?>
<?php
$var_mensaje = "";
if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $variedad = $_POST['variedad'];
    $procedencia = $_POST['procedencia'];
    
    if (logged_in()) {
        $var_mensaje = Plantas($nombre, $especie, $variedad, $procedencia, null);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}
$registros = obtener_todas_plantas();
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
        <title>Plantas no tradicionales</title>	

        <div class="container">
            <a href="ingreso.PHP">Agregar nueva Planta</a>
            <div class="table-responsive">
                <table  class="table table-striped">
                <thead class="thead-default">
                    <tr>
                        <th>NOMBRE</th>    
                        <th>ESPECIE</th>    
                        <th>VARIEDAD</th>
                        <th>PROCEDENCIA</th>   
                        
                    </tr>   
                </thead>
                <?php foreach ($registros as $reg) { ?>  
                    <tr>
                        <td><?php echo $reg['nomb_planta']; ?></td>  
                        <td><?php echo $reg['especie']; ?></td>    
                        <td><?php echo $reg['variedad']; ?></td>
                        <td><?php echo $reg['lugar_Procedencia']; ?></td> 
                       
                        <td><a href="ingreso.PHP?id=<?php echo $reg['cod_planta']; ?>">Actualizar</a></td>  
                        <?php
                    }
                    ?>
            </table>
                
                
                
            </div>
            



        </div>

    </div>

    </body>
</html>
