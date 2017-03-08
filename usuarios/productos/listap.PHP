
<?php
require_once ("../../includes/conexion.php");
require_once ("../../includes/funciones.php");
require_once ("../../includes/diseno/cabezera.php");
?>

<?php
$var_mensaje = "";
if (isset($_POST['submit'])) {
    $tipo = $_POST['tipo'];
    $nombrec = $_POST['nombrec'];
    $principioa = $_POST['principioa'];
    $cantidadp = $_POST['cantidadp'];
    $fechaelab = $_POST['fechaelab'];
    $fechacadu = $_POST['fechacadu'];
    $unidad = $_POST['unidad'];
    $tipo_sl = $_POST['tipo_sl'];
    if (logged_in()) {
        $var_mensaje = Productos($tipo, $nombrec, $principioa, $cantidadp, $fechaelab, $fechacadu, $tipo_sl, $unidad);
        $var_mensaje = "Datos";
    } else {
        $var_mensaje = "Datos insertadas";
    }
}


?>
<script src="../../js/angular.min.js"></script>
<script src="../../js/angularunidades.js"></script>
<html ng-app="App" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ecuaforestar</title>     
   
    </head>
    <body ng-controller="ProductoCtrl">
       
        <?php echo $cabezera; ?>


        <div class="container">
            <a href="ingresop.PHP">Nueva</a>
            <h1 class="conCabezera">Productos Químicos:</h1>
          
                <table  class="table table-striped">
                <thead class="thead-default">
                    <tr >

                        <th>PRODUCTO</th>    
                        <th>PRINCIPIO ACTIVO</th>
                        <th >CANTIDAD TOTAL</th>
                        <th >
                            <select style="" name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                                    ng-model="unidad_sel_liquido" required> 
                            </select >  
                            
                            <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                                    ng-model="unidad_sel_solido" required> 
                            </select> 
                        </th>
                        <th>FECHA ELABORACIÓN</th>  
                        <th>FECHA VENCIMINETO</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>   
                </thead>

                <tr ng-repeat="producto in quimico" class="{{producto.estilo}}">

                    <td>{{producto.nombre_com}}</td>  
                    <td>{{producto.principio_activo}}</td>  
                    <td>{{cantidad(producto.estado_sl, producto.cantidad_prod)}}</td>
                    <td>{{unidad_label(producto.estado_sl)}}</td>
                    <td>{{producto.fecha_elab}}</td>    
                    <td>{{producto.fecha_cadu}}</td>
                    <td >{{producto.edad}}</td>
                    <td><a href="ingresop.PHP?id={{producto.id_producto}}">Actualizar</a></td>
                    <td><a href="maspro.PHP?id={{producto.id_producto}}">+ Cantidad</a></td>
                </tr>
            </table>
                
                
                
           
            
            <a href="ingresop.PHP">Nueva</a>
            <h1 class="conCabezera" >Productos Orgánicos:</h1>
            <div class="table-responsive">
                <table  class="table table-striped">
                <thead class="thead-default">
                    <tr >

                        <th>PRODUCTO</th>    
                        <th>PRINCIPIO ACTIVO</th>
                        <th >CANTIDAD TOTAL </th >
                        <th >
                            <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                                    ng-model="unidad_sel_liquido" required> 
                            </select>  
                            
                            <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                                    ng-model="unidad_sel_solido" required> 
                            </select> 
                        </th>
                        <th>FECHA ELABORACIÓN</th>  
                        <th>FECHA VENCIMINETO</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>   
                </thead>
                <tr ng-repeat="producto in organico" class="{{producto.estilo}}">

                    <td>{{producto.nombre_com}}</td>  
                    <td>{{producto.principio_activo}}</td>  
                    <td>{{cantidad(producto.estado_sl, producto.cantidad_prod)}}</td>
                    <td>{{unidad_label(producto.estado_sl)}}</td>
                    <td>{{producto.fecha_elab}}</td>    
                    <td>{{producto.fecha_cadu}}</td>
                    <td>{{producto.edad}}</td>
                    <td><a href="ingresop.PHP?id={{producto.id_producto}}">Actualizar</a></td>
                    <td><a href="maspro.PHP?id={{producto.id_producto}}">+ Cantidad</a></td>
                </tr>

            </table>
                
                
            </div>
            
            <a href="ingresop.PHP">Nueva</a>
        </div>
             
     
        </body>
</html>
