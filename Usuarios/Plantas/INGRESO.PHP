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
$nombre = "";
$especie = "";
$variedad = "";
$procedencia = "";
$identi = "";
$siguiente_pagina = "LISTA.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACION.PHP?id=" . $_GET['id'];
    $planta_buscada = obtener_planta_por_id($_GET['id']);
    if ($planta_buscada != NULL) {
        $nombre = $planta_buscada[0]['nomb_planta'];
        $especie = $planta_buscada[0]['especie'];
        $variedad = $planta_buscada[0]['variedad'];
        $procedencia = $planta_buscada[0]['lugar_Procedencia'];
        $identi = $planta_buscada[0]['identificativo'];
    }
}
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
    <link rel='stylesheet'type='text/css' href="estilo.css" media="all"/>
    <body>
        <div class="row">
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
                                <td>Identificativo</td>
                                <td>
                                    <input type="text" name="identi" maxlength="20" value="<?php echo $identi; ?>" required>
                                </td>
                            </tr>
                            <tr>

                                <td colspan="2">
                                    <input class="btn btn-success "  type="submit" name="submit" value="Aceptar">
                                    <a href="LISTA.PHP">Lista de Plantas</a></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>

    </body>
</html>
+ 