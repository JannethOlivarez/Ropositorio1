

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
$num_lote = "";
$estado = "";
$planta="";
$siguiente_pagina = "listal.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "actualizacionl.PHP?id=" . $_GET['id'];
    $lote_buscado = obtener_Lote_por_id($_GET['id']);
    if ($lote_buscado != NULL) {
        $num_lote = $lote_buscado[0]['num_lote'];
        $estado = $lote_buscado[0]['estado'];
        $planta=$lote_buscado[0]['nomb_planta'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     
     
    </head>

    <body>
       
            <?php echo $cabezera; ?>
            <div class="container">
                <div id="contenido Plantas">
                    <h2>Datos de  Nuevo Lote:</h2>
                    <form action="<?php echo $siguiente_pagina; ?>" method="post">
                        <table>
                            <tr>
                                <td>Número:</td>
                                <td>
                                   <?php echo $num_lote; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Planta:</td>
                                <td>
                                   <?php echo $planta; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Estado:</td>

                                <td>
                                    <select name="estado">                         
                                        <option value="activo">activo</option>      
                                        <option value="inactivo">inactivo</option>                           
                                    </select></td>

                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input class="btn btn-success" type="submit" name="submit" value="Aceptar">
                                    <a href="listal.PHP">Lista de Lotes</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
           
<!--            <script src="../../js/jquery.js"></script>
            <script src="../../js/bootstrap.min.js"></script>-->
         </div>   
    </body>
</html>