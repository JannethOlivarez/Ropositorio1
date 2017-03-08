 
<?php


$arrayUrl = explode('/', $_SERVER['REQUEST_URI']);
$num = 4;

$archivoArray=  explode(".", $arrayUrl[$num]);

$archivo=$archivoArray[0];
function selectNav($url, $nav,$ur2=null) {
    if (strcmp($url, $nav) === 0) {
        return ' active';
    }
    if ($ur2!=null){
        if (strcmp($url, $ur2) == 0) {
        return ' active';
    }
    }
}

$cabezera = '
            <head>
             <link rel="stylesheet" href="/Ecuaforestar/includes/diseno/css/bootstrap.min.css">
        
        <script src="/Ecuaforestar/includes/diseno/js/jquery.js"></script>
         <script src="/Ecuaforestar/includes/diseno/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="/Ecuaforestar/includes/diseno/css/estilos.css"> 
<img src="../../imagenes/imagen2.png" class="img-responsive logo" alt="Imagen responsive">                                   
<nav class="navbar navbar-default" role="navigation">
                    <!-- El logotipo y el icono que despliega el menú se agrupan
                         para mostrarlos mejor en los dispositivos móviles -->
                         
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Desplegar navegación</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                    </div>

                    <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                         otro elemento que se pueda ocultar al minimizar la barra -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li ><a href="/Ecuaforestar/usuarios/menu.php">Inicio</a></li>                           
                            <li class="dropdown '.  selectNav($archivo, 'listal','ingresol').'">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Lotes <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/Ecuaforestar/usuarios/lotes/listal.PHP">Ver Lista de lotes</a></li>
                                </ul>
                            </li>
                            <li class="dropdown '.  selectNav($archivo, 'lista','ingreso').'">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Plantas<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/Ecuaforestar/usuarios/plantas/ingreso.PHP">Agregar</a></li>
                                    <li><a href="/Ecuaforestar/usuarios/plantas/lista.PHP">Ver Lista de plantas</a></li>
                                </ul>
                            </li>
                            <li class="dropdown '.  selectNav($archivo, 'listap','ingresop').'">
                                <a class="dropdown-toggle" data-toggle="dropdown">
                                    Productos<b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/Ecuaforestar/usuarios/productos/ingresop.PHP">Agregar</a></li>
                                    <li><a href="/Ecuaforestar/usuarios/productos/listap.PHP">Ver Lista de Productos</a></li>
                                </ul>
                            </li>
                            <li class="dropdown '.  selectNav($archivo, 'listav','ingresov').'">
                                <a class="dropdown-toggle" data-toggle="dropdown">
                                    Siembras <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/Ecuaforestar/usuarios/plantasLotes/ingresov.PHP">Realizar vinculacion de Lotes y Plantas #1</a></li>
                                    <li><a href="/Ecuaforestar/Usuarios/PlantasLotes/listav.PHP">Ver Lista Lotes-Plantas</a></li>
                                </ul>
                            </li>
                            <li class="dropdown '.  selectNav($archivo, 'listaa','ingresoa').'">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Aplicaciones de Productos <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/Ecuaforestar/usuarios/aplicaciones/ingresoa.PHP">Registrar nuevas Aplicaciones</a></li>
                                    <li><a href="/Ecuaforestar/Usuarios/Aplicaciones/listaa.PHP">Ver Lista de Aplicaciones</a></li>
                                    <li><a href="/Ecuaforestar/Usuarios/Aplicaciones/listaar.PHP">Lista de Reagendamientos</a></li>
                                </ul>
                            </li>
                            
                            <li class="'.  selectNav($archivo, 'consultas').'">
                                
                                
                                    <a href="/Ecuaforestar/usuarios/consultas/consultas.PHP">
                                    Consultas 
                                </a>
                               
                            </li>
                        </ul>
                    </div>
                </nav>
            </head>    
            
      '
;
?>
<?php

$cabezerapuesta = '<thead class="thead-default">
                <tr>
                    <th>N° Lote</th>  
                    <th>PLANTA</th>
                    <th>TRATAMIENTO</th>
                    <th>TIPO DE PRODUCTO</th>  
                    <th>PRODUCTO</th> 
                    <th colspan="2">CANTIDAD APLICADA
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                        ng-model="unidad_sel_liquido" required> 
                    </select>  
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                        ng-model="unidad_sel_solido" required> 
                    </select> 
                    </th> 
                    <th>PROXIMA APLICACION</th> 
                    </tr>   
            </thead>'
;
?>

<?php

$cabezeraPlanta = '<thead class="thead-default">
                <tr>
                    <th>PRODUCTOS APLICADOS</th>  
                    <th>N° Lote</th>                    
                    <th>TRATAMIENTO</th>                   
                    <th colspan="2">CANTIDAD APLICADA
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                        ng-model="unidad_sel_liquido" required> 
                    </select>  
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                        ng-model="unidad_sel_solido" required> 
                    </select> 
                    </th> 
                    <th>FECHA DE APLICACION</th> 
                    <th>PROXIMA APLICACION</th> 
                    </tr>   
            </head>'
;
?>

<?php

$cabezeraProducto = '<thead class="thead-default">
                <tr>
                    <th>N° Lote</th>  
                    <th>PLANTA</th>                                                     
                    <th colspan="2">CANTIDAD APLICADA
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_liquido track by unidad.id"
                        ng-model="unidad_sel_liquido" required> 
                    </select>  
                    <br>
                    <select name="unidad" id="unidad"    ng-options="unidad as unidad.label for unidad in unidades_solido track by unidad.id"
                        ng-model="unidad_sel_solido" required> 
                    </select> 
                    </th> 
                    <th>FECHA DE APLICACION</th> 
                    </tr>   
            </thead>'
;
?>

<?php

$cabezeraProximaApp = '<thead class="thead-default">
                <tr>
                    <th>PROXIMAS APLICACIONES</th>  
                    <th>Nº LOTE</th>
                    <th>PLANTA</th>
                    <th>PRODUCTO</th>  
                    <th>TRATAMIENTO</th>                                    
                    </tr>   
            </thead>'
;
?>

<?php
 
