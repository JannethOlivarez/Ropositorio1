

<?php
require_once ("../../includes/conexion.php");
require_once ("../../includes/funciones.php");
require_once ("../../includes/diseno/cabezera.php");
?>
<?php
$var_mensaje = "";
$planta = "";
$lote = "";
$fechaSiembra = "";
$cantidadplantas = "";
$siguiente_pagina = "listav.PHP";
$numLote="";
$nombrePlant="";
if (isset($_GET['id'])) {
    $siguiente_pagina = "actualizacionv.PHP?id=" . $_GET['id'];
    $vinculacion_buscada = obtener_Vinculacion_por_id($_GET['id']);
    if ($vinculacion_buscada != NULL) {
        $planta = $vinculacion_buscada[0]['id_planta'];
        $lote = $vinculacion_buscada[0]['id_lote'];
        $numLote=$vinculacion_buscada[0]['num_lote'];
        $fechaSiembra = $vinculacion_buscada[0]['fecha_siembra'];
        $cantidadplantas = $vinculacion_buscada[0]['cant_plantas'];
        $nombrePlant=$vinculacion_buscada[0]['nomb_planta'];
    }
}
$plantas = obtener_todas_plantas();
$lotes = obtener_todas_lotes();

?>

<!DOCTYPE html>
<html ng-app="App">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     

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
                                
                                <?php if (!isset($_GET['id'])) {?>  
                                <select name="planta">
                                    <?php foreach ($plantas as $planta) { ?>
                                        <option value="<?php echo $planta['cod_planta']; ?> "><?php echo $planta['nomb_planta']; ?></option>
                                    <?php } ?>
                                </select>
                            <?php  }else { echo $nombrePlant; }?>
                            </td>
                        </tr>
                        <tr  <?php if (!isset($_GET['id'])) { echo 'class=ocultar';  }?>>
                            <td>Lote Nº:</td>
                            <td>
                                <?php echo $numLote; ?>
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
                                <input type="number" name="cantidadplantas" maxlength="20" value="<?php echo $cantidadplantas; ?>" required>
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
