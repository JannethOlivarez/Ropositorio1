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
$var_mensaje = "";
$lote = "";
$planta = "";
$fsiembra = "";
$especie = "";
$identi = "";
$cantidad = "";
$ini = "";
$siguiente_pagina = "LISTAV.PHP";
$cod_lote = "";
$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $vinculacion_buscada = obtener_Plantita($_GET['id']);
    if ($vinculacion_buscada != NULL) {
        $lote = $vinculacion_buscada[0]['num_lote'];
        $planta = $vinculacion_buscada[0]['nomb_planta'];
        $fsiembra = $vinculacion_buscada[0]['fecha_siembra'];
        $especie = $vinculacion_buscada[0]['especie'];
        $variedad = $vinculacion_buscada[0]['variedad'];
        $identi = $vinculacion_buscada[0]['identificativo'];
        $cantidad = $vinculacion_buscada[0]['cant_plantas'];

        $iniciales = explode(" ", $planta);

        if (count($iniciales) == 1) {
            $ini = substr($iniciales[0], 0, 2);
        } else if (count($iniciales) > 1) {

            $ini = substr($iniciales[0], 0, 1) . substr($iniciales[1], 0, 1);
        }
   
        for ($index = 0; $index < 4 - strlen($lote); $index++) {
            $cod_lote = "0" . $cod_lote;
        }
        $cod_lote .=$lote;
    }
}


if (isset($_POST['personalizado'])) {
    print_r($_POST);
}
?>
<script src="../../js/angular.min.js"></script>
<style media="screen" type="text/css">/*<![CDATA[*/@import '../../css/font/stylesheet.css';/*]]>*/</style>
<script >
    var countryApp = angular.module('App', []);
    countryApp.controller('EtqCtrl', function ($scope, $http) {

    });
</script>
<style>

    .g{font-family:"C39HrP24DhTt";
       font-size: 65px;
       float:left;text-align:center;padding:0 3px 0 3px;border-right:1px solid #eeeeee;white-space:nowrap;overflow:hidden;margin-bottom:20px;min-height:100px
    }
</style>
<style type="text/css"></style>
<!DOCTYPE html>
<html ng-app="App" >
    <head>
        <title>Etiquetas</title>
    </head>
    <body ng-controller="EtqCtrl">
        <h2>Generar Etiquetas </h2>
        <br />

        <table>
            <tr>
                <td> Lote Nº:</td>
                <td><?php echo $lote; ?></td>
            </tr>
            <tr>
                <td> Planta:</td>
                <td><?php echo $planta; ?></td>
            </tr>
            <tr>
                <td> Fecha de Siembra:</td>
                <td><?php echo $fsiembra; ?></td>
            </tr>
            <tr>
                <td> Especie:</td>
                <td><?php echo $especie; ?></td>
            </tr>
            <tr>
                <td> Variedad:</td>
                <td><?php echo $variedad; ?></td>
            </tr>
        </table>



        <br />

        <a href="LISTAV.PHP">Regresar a lista </a>
        <div>
            <h3>Estructura Etiqueta</h3>
            2 PRIMERAS LETRAS : INICIALES PLANTA  &#60;<?php echo $ini; ?>&#62;<br />
            4 SIGUIENTE LETRAS: NÚMERO LOTE &#60;<?php echo $cod_lote; ?>&#62;<br />
            RESTO NÚMERO DE PLANTA &#60;### &#62;<br />
        </div>
        <hr>

        <form action="ETIQUETA.php?id=<?php echo $id; ?>" method="post">

            Generar desde <input type="number" name="desde" ng-model="desde"> <br />
            Generar hasta <input type="number" name="hasta" ng-model="hasta" value="<?php echo $cantidad; ?>" > Máximo: <?php echo "{{total=$cantidad}}"; ?>
            Número de Columnas <input type="number" name="numero" ng-model="desde" required> <br />

            <br />
            <input type="submit" value="Generar Rango Personalido" name="personalizado"> 
            <input type="submit" value="Generar Todas" name="todo"> 
        </form>
        <?php
        if (isset($_POST['todo'])) {
            echo "<table>";
            for ($index1 = 0; $index1 <= $cantidad; $index1++) {
                ?>


            <tr>
                <?php
                for ($index2 = 0; $index2 < 4; $index2++) {
                    if ($index1 < $cantidad) {
                        $index1++;
                    }
                    ?>    
                    <td> <?php echo $ini . $cod_lote . "0" . $index1 ?></td>
                    <td> <div id="glyphs"><div class="g"> <?php echo $ini . $cod_lote . "0" . $index1 ?></div></div></td>
        <?php } ?>
            </tr>


            <?php
        }
        echo "</table>";
    }
    ?>
</body>
</html>