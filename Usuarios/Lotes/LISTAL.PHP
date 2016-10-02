<?php require_once ("../../Includes/SESSION.php"); ?>
<?php require_once ("../../Includes/CONEXION.php"); ?>
<?php require_once ("../../Includes/FUNCIONES.php"); ?>
<?php require_once ("../../Includes/DISENO/CABEZERA.php"); ?>

<?php
$var_mensaje = "";
if (isset($_POST['submit'])) {
    $num_lote = $_POST['num_lote'];
    $estado = $_POST['estado'];
    if (logged_in()) {
        $var_mensaje = Lotes($num_lote, $estado);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}
$registros = obtener_todas_lotes();
?>  
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <?php echo $cabezera; ?>
        <title>Lotes</title> 
        <div class="container">
            <a href="INGRESOL.PHP">Agregar nuevo Lote</a>
            <table  class="table table-striped">
                <thead class="thead-default">
                    <tr >
                        <th >NUMERO DE lOTE</th>      
                        <th >ESTADO DE lOTE</th>      
                    </tr>     
                </thead>
                <?php foreach ($registros as $reg) { ?>  
                    <tr>
                        <td><?php echo $reg['num_lote']; ?></td>
                        <td><?php echo $reg['estado']; ?></td>    
                        <td><a href="INGRESOL.PHP?id=<?php echo $reg['cod_lote']; ?>">Actualizar</a></td>  
                        <?php
                    }
                    ?>



                    <!DOCTYPE html>


            </table>
        </div>				
    </body>
</html>
