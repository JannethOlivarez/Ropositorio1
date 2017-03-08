
<?php
mb_internal_encoding('UTF-8');
 
// Esto le dice a PHP que generaremos cadenas UTF-8
mb_http_output('UTF-8');
require_once ("../../includes/conexion.php");
require_once ("../../includes/funciones.php");

if(isset($_GET['id']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacion')==0){
        $aplicacion=  obtener_aplicacion_por_id_planta($_GET['id']);
        print json_encode($aplicacion);
    }
}
if(isset($_GET['id']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacionprod')==0){
        $registros=  obtener_aplicacion_por_id_producto($_GET['id']);
         $date1 = new DateTime("now");
       
        for ($index = 0; $index < count($registros); $index++) {
            $date2 = new DateTime($registros[$index]['edad']);
            $interval = date_diff($date1, $date2);
            $registros[$index]['edad']=edad($interval->format('%y'), $interval->format('%m'), $interval->format('%d'));
        }
        
        print json_encode($registros);
    }
}

if(isset($_GET['fecha']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'consultafecha')==0){
        $consultafecha=  obtener_aplicacion_por_fechaUnica($_GET['fecha']);
        print json_encode($consultafecha);
    }
}
function edad($año, $mes, $dias) {
    $edad = "";
    if ($año != 0) {
        if ($año == 1) {
            $edad .= "1 año ";
        } else {
            $edad .= $año." años ";
        }
    }
    if ($mes != 0) {
        if ($mes == 1) {
            $edad .= "1 mes ";
        } else {
            $edad .= $mes." meses ";
        }
    }
    if ($dias != 0) {
        if ($dias == 1) {
            $edad .= "1 dìa ";
        } else {
            $edad .= $dias." dìas ";
        }
    }
    return $edad;
}

if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'proximasAplicaciones')==0){
        $registros = obtener_todas_aplicaciones_pendientes();       
        $date1 = new DateTime("now");
       
        for ($index = 0; $index < count($registros); $index++) {
            $date2 = new DateTime($registros[$index]['edad']);
            $interval = date_diff($date1, $date2);
            $registros[$index]['edad']=edad($interval->format('%y'), $interval->format('%m'), $interval->format('%d'));
        }

        print json_encode($registros);
    }
}
if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacionesPasadas')==0){
        $registros = obtener_todas_aplicaciones_pasadas();
        print json_encode($registros);
    }
}

if(isset($_GET['id']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'lotesActivos')==0){
        
        $registros = obtener_todas_vinculaciones_activas($_GET['id']);
        print json_encode($registros);
    }
}
 if(isset($_GET['id']) && isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'siembrasActivas')==0){
        $registros = obtener_todas_vinculaciones_activas($_GET['id']);
        print json_encode($registros);
    }
}    
 if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'plantasSiembras')==0){
        $registros = obtener_todas_plantas_vinculaciones_activas();
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
if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacionFecha2')==0){
        $ini='1';
        $fin='1';
        
        if(isset($_GET['ini'])){
           $ini= $_GET['ini'];
        }
        if(isset($_GET['fin'])){
           $fin= $_GET['fin'];
        }
        $aplicacion= obtener_aplicacion_por_fecha2($ini,$fin);
        print json_encode($aplicacion);
    }
}
if(isset($_GET['consulta'])){
    if(strcmp($_GET['consulta'], 'aplicacionesReagendadas')==0){
       
        $aplicacion=obtener_aplicaciones_reagendadas();
        print json_encode($aplicacion);
    }
}
?>
