

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
$nombre = "";
$especie = "";
$variedad = "";
$procedencia = "";
$siguiente_pagina = "lista.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "actualizacion.PHP?id=" . $_GET['id'];
    $planta_buscada = obtener_planta_por_id($_GET['id']);
    if ($planta_buscada != NULL) {
        $nombre = $planta_buscada[0]['nomb_planta'];
        $especie = $planta_buscada[0]['especie'];
        $variedad = $planta_buscada[0]['variedad'];
        $procedencia = $planta_buscada[0]['lugar_Procedencia'];     
    }
}?>
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
                    <h2>Ingrese los datos de la nueva planta</h2>
                    <form action="<?php echo $siguiente_pagina; ?>" method="post">
                        <table>
                            <tr>
                                <td>Nombre</td>
                                <td>
                                    <input type="text" name="nombre" maxlength="20" value="<?php echo $nombre; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Especie:</td>
                                <td>
                                    <input type="text" name="especie" maxlength="20" value="<?php echo $especie; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Variedad:</td>
                                <td>
                                    <input type="text" name="variedad" maxlength="20" value="<?php echo $variedad; ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Lugar de procedencia</td>
                                <td>
                                    <input type="text" name="procedencia" maxlength="20" value="<?php echo $procedencia; ?>" required>
                                </td>
                            </tr>                      
                            <tr>

                                <td colspan="2">
                                    <input class="btn btn-success "  type="submit" name="submit" value="Aceptar">
                                   
                            </tr>
                            <tr>

                                <td colspan="2">
                                    
                                    <a href="lista.PHP">Lista de Plantas</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            
        
    </body>
</html>
