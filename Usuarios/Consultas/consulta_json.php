
<?php
require_once ("../../Includes/CONEXION.php");
require_once ("../../Includes/FUNCIONES.php");

if(isset($_GET['id']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacion')==0){
        $aplicacion=  obtener_aplicacion_por_id_planta($_GET['id']);
        print json_encode($aplicacion);
    }
}
if(isset($_GET['id']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacionprod')==0){
        $aplicacionprod=  obtener_aplicacion_por_id_producto($_GET['id']);
        print json_encode($aplicacionprod);
    }
}

if(isset($_GET['fecha']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'consultafecha')==0){
        $consultafecha=  obtener_aplicacion_por_fechaUnica($_GET['fecha']);
        print json_encode($consultafecha);
    }
}

if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'proximasAplicaciones')==0){
        $registros = obtener_todas_aplicaciones();
        print json_encode($registros);
    }
}

     

if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacionFecha')==0){
        $ini='1';
        $fin='1';
        
        if(isset($_GET['ini'])){
           $ini= $_GET['ini'];
        }
        if(isset($_GET['fin'])){
           $fin= $_GET['fin'];
        }
        $aplicacion= obtener_aplicacion_por_fecha($ini,$fin);
        print json_encode($aplicacion);
    }
}








?>
