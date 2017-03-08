

<?php require_once ("../../includes/conexion.php"); ?>
<?php require_once ("../../includes/funciones.php"); ?>
<?php require_once ("../../includes/diseno/cabezera.php"); ?>

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
<html lang="es">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     
     
    </head>
    <?php echo $cabezera; ?>
    <body>
        <div class="row">      
            <title>Lotes</title> 
            <div class="container">
               
                <div class="table-responsive">
                    <table  class="table  table-bordered table-responsive">
                        <thead class="thead-inverse">
                            <tr >
                                <th >NUMERO DE LOTE</th>
                                <th >PLANTA</th>   
                                <th >ESTADO DE LOTE</th> 
                                <th ></th>  
                            </tr>     
                        </thead>
                        <?php foreach ($registros as $reg) { ?>  
                            <tr>
                                <td><?php echo $reg['num_lote']; ?></td>
                                 <td><?php echo $reg['nomb_planta']; ?></td>  
                                <td><?php echo $reg['estado']; ?></td>    
                                <td><a href="ingresol.PHP?id=<?php echo $reg['cod_lote']; ?>">Actualizar</a></td>  
                                <?php
                            }
                            ?>
                    </table>
                </div>
            </div>				
    
        </div>>
    </body>
</html>
