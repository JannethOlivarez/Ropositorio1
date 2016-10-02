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
require_once ("../../Includes/DISENO/CABEZERA.php");

?>

<?php
$var_mensaje = "";
/* @var $_POST type */
if (isset($_POST['submit'])) {

    $nombreProducto = $_POST['nombreprod'];
    $nombrePlanta = $_POST['nombreplanta'];
    echo $nombreProducto;
    $tratamiento = $_POST['tratamiento'];
    $cantidad = $_POST['cantidad'];
    $fechaAplicacion = $_POST['fechaAplicacion'];
    $fechaProxima = $_POST['proximaAplicacion'];
    if (logged_in()) {
        $var_mensaje = Aplicacion($nombrePlanta, $nombreProducto, $tratamiento, $cantidad, $fechaAplicacion, $fechaProxima);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}
$registros = obtener_todas_aplicaciones();
?>
<!DOCTYPE html>
<html ng-app="App">
    <head>
        <script src="../../js/angular.min.js"></script>
        <script src="../../js/miangular.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body ng-controller="PlantaCtrl">
        <div class="row">
             <?php echo $cabezera; ?>	    
            <title>Plantas no tradicionales</title>
            <div class="container">
                <a href="INGRESOA.PHP">Agregar nueva Aplicacion</a>
            <table  class="table table-striped">
                <thead class="thead-default">
                    <tr>
                        <th>TIPO DE PRODUCTO</th>    
                        <th>PRODUCTO</th>    
                        <th>PLANTA</th>
                        <th>TRATAMIENTO</th>
                        <th>CANTIDAD APLICADA</th>  
                        <th>FECHA APLICACION</th>  
                        <th>PROXIMA APLICACION</th>     
                    </tr>   
                </thead>
                <?php foreach ($registros as $reg) { ?>  
                    <tr>
                        <td><?php echo $reg['tipo_producto']; ?></td>  
                        <td><?php echo $reg['nombre_com']; ?></td>    
                        <td><?php echo $reg['nomb_planta']; ?></td>
                        <td><?php echo $reg['tipotratamiento']; ?></td>
                        <td><?php echo $reg['cant_aplicada']; ?></td> 
                        <td><?php echo $reg['fecha_aplicacion']; ?></td> 
                        <td><?php echo $reg['fecha_prox']; ?></td>  
                        <td><a href="<?php echo 'INGRESOA.PHP?id='.$reg['id_aplicacion']; ?>">Actualizar</a></td>  
                        <?php
                    }
                    ?>
            </table>  {{selectedOption}}  
        </div>
            				
    </body>
