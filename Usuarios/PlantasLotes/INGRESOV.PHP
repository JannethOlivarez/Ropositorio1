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
$planta = "";
$lote = "";
$fechaSiembra = "";
$cantidadplantas = "";
$siguiente_pagina = "LISTAV.PHP";
if (isset($_GET['id'])) {
    $siguiente_pagina = "ACTUALIZACIONV.PHP?id=" . $_GET['id'];
    $vinculacion_buscada = obtener_Vinculacion_por_id($_GET['id']);
    if ($vinculacion_buscada != NULL) {
        $planta = $vinculacion_buscada[0]['id_planta'];
        $lote = $vinculacion_buscada[0]['id_lote'];
        $fechaSiembra = $vinculacion_buscada[0]['fecha_siembra'];
        $cantidadplantas = $vinculacion_buscada[0]['cant_plantas'];
    }
}
$plantas = obtener_todas_plantas();
$lotes = obtener_todas_lotes();
?>

<!DOCTYPE html>
<html ng-app="App">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script scr="js/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>

    <div class="row">
        <?php echo $cabezera; ?>
        <div class="container">

            <div id="contenido Plantas">
                <h2>Vinculación de Lotes y Plantas:</h2>
                <form action="<?php echo $siguiente_pagina; ?>" method="post">
                    <table>
                        <tr>
                            <td>Planta:</td>
                            <td>
                                <select name="planta">
                                    <?php foreach ($plantas as $planta) { ?>
                                        <option value="<?php echo $planta['cod_planta']; ?> "><?php echo $planta['nomb_planta']; ?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Lote Nº:</td>
                            <td>
                                <select name="lote">
                                    <?php foreach ($lotes as $lote) { ?>
                                        <option value="<?php echo $lote['cod_lote']; ?>"><?php echo $lote['num_lote']; ?>
                                        <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Fecha de Siembra:</td>
                            <td>
                                <input type="date" name="fechaSiembra" maxlength="20" value="<?php echo $fechaSiembra; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Cantidad de Plantas:</td>
                            <td>
                                <input type="text" name="cantidadplantas" maxlength="20" value="<?php echo $cantidadplantas; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input class="btn btn-success" type="submit" name="submit" value="Aceptar">                                              
                                <a href="LISTAV.PHP">Registro de Lotes y Plantas</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>
