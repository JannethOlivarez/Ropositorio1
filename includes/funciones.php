<?php

require_once ("session.php");
confirmar_logged_in();
?>
<?php

function Redireccionar($ubicacion = NULL) {
    if ($ubicacion != NULL) {
        header("Location: {$ubicacion}");
        exit;
    }
}

//*****************Usuario y Contraseña***************
function Login($usuario, $contrasena) {
    global $var_mysqli;
    $query = "SELECT codigo, usuario,contrasena FROM identificacion where usuario=? limit 1";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("s", $usuario)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $usuario = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($usuario);
    if ($row == 1 && strcmp($contrasena, $usuario[0]['contrasena']) == 0) {
        $_SESSION['codigo'] = $usuario[0]['codigo'];
        $_SESSION['usuario'] = $usuario[0]['usuario'];
        $_SESSION['contrasena'] = $usuario[0]['contrasena'];
        return "Logeado";
    } else {
        return '<tr ><td></td><td style=" background-color: red">Usuario o Contraseña Incorrecto</td></tr>';
    }
}

//****************     Plantas      *********************************************
?>


<?php

function obtener_todas_plantas() {
    global $var_mysqli;
    $query = "SELECT * FROM plantas";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function Plantas($nombre, $especie, $variedad, $procedencia, $identi) {
    global $var_mysqli;
    $query = "INSERT INTO plantas (nomb_planta,especie,variedad,lugar_Procedencia) values (?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("ssss", $nombre, $especie, $variedad, $procedencia)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function obtener_planta_por_id($id) {
    global $var_mysqli;
    $query = "SELECT * FROM plantas where cod_planta=? limit 1";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($planta);
    if ($row == 1) {
        return $planta;
    } else {
        return NULL;
    }
}

//****************     Lotes      *********************************************
?>

<?php

function obtener_todas_lotes() {
    global $var_mysqli;
    $query = "SELECT l.*,p.nomb_planta FROM lotes l,vinculacion v, plantas p where l.cod_lote=v.id_lote and "
            . "v.id_planta=p.cod_planta order by p.nomb_planta,l.num_lote";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function obtener_todas_lotes_activos() {
    global $var_mysqli;
    $query = "SELECT * FROM lotes where estado='activo'";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function Lotes($num_lote, $estado) {
    global $var_mysqli;
    $query = "INSERT INTO lotes (num_lote,estado) values (?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("is", $num_lote, $estado)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function obtener_Lote_por_id($id) {
    global $var_mysqli;
    $query = "SELECT l.*,p.nomb_planta FROM lotes l,vinculacion v, plantas p where l.cod_lote=v.id_lote and "
            . "v.id_planta=p.cod_planta and cod_lote=? limit 1";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $lote = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($lote);
    if ($row == 1) {
        return $lote;
    } else {
        return NULL;
    }
}

//****************     Plantas -Lotes      *********************************************
?>


<?php

function obtener_todas_vinculaciones() {
    global $var_mysqli;
    $query = "SELECT v.id_vinculacion, p.nomb_planta, l.num_lote, v.fecha_siembra, v.cant_plantas FROM vinculacion v, plantas p, lotes l WHERE v.id_planta = p.cod_planta and l.cod_lote=v.id_lote";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function obtener_todas_vinculaciones_activas($id) {
    global $var_mysqli;
    $query = "SELECT v.id_vinculacion, p.nomb_planta, l.num_lote, v.fecha_siembra, v.cant_plantas FROM vinculacion v, plantas p, lotes l "
            . " WHERE v.id_planta = p.cod_planta and l.cod_lote=v.id_lote "
            . " and v.estado=1 and v.id_planta=?";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}
function obtener_todas_plantas_vinculaciones_activas() {
    global $var_mysqli;
    $query = "SELECT * FROM plantas p WHERE (select COUNT(*) from vinculacion where id_planta=cod_planta and estado=1)>0";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}
function Vinculacion($planta, $fechaSiembra, $cantidadplantas) {
    global $var_mysqli;
    $num_lote=  obtener_siguiente_lote($planta);
    
    Lotes($num_lote, "activo");
    $lote=$var_mysqli->insert_id;
    $query = "INSERT INTO vinculacion (id_planta,id_lote,fecha_siembra,cant_plantas) values (?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("iisi", $planta, $lote, $fechaSiembra, $cantidadplantas)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}
function obtener_siguiente_lote($id_planta){
    global $var_mysqli;
     $query = "select COALESCE(MAX(num_lote),0)+1 siguiente from lotes where cod_lote in (SELECT id_lote FROM vinculacion WHERE id_planta = ?)";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id_planta)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $vinculacion = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);

 
   
    return $vinculacion[0]['siguiente'];
    
        
        
}
function obtener_Vinculacion_por_id($id) {
    global $var_mysqli;
    $query = "SELECT v.*,l.num_lote,p.nomb_planta FROM vinculacion v , lotes l, plantas p  where id_vinculacion=?  and v.id_lote = l.cod_lote and v.id_planta=p.cod_planta limit 1";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $vinculacion = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($vinculacion);
    if ($row == 1) {
        return $vinculacion;
    } else {
        return NULL;
    }
}

//****************    Etiqueta     *********************************************
?>

<?php

function obtener_Plantita($id) {
    global $var_mysqli;
    $query = "SELECT l.num_lote, pl.nomb_planta,v.fecha_siembra,pl.especie,pl.variedad,v.cant_plantas from plantas pl, vinculacion v, lotes l where l.cod_lote=v.id_lote AND pl.cod_planta = v.id_planta AND v.id_vinculacion=?";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $vinculacion = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($vinculacion);
    if ($row == 1) {
        return $vinculacion;
    } else {
        return NULL;
    }
}
?>




<?php

function optener_todos_productos() {
    global $var_mysqli;
    $query = "SELECT * FROM productos order by estado_actividad desc,tipo_producto,nombre_com asc";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
    
}

function productos_quimico() {
    global $var_mysqli;
    $query = "SELECT *,'' as edad,'' estilo FROM productos where tipo_producto= 'Quimico' and estado_actividad=1 order by nombre_com asc";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $registros = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $date1 = new DateTime("now");
    
    for ($index = 0; $index < count($registros); $index++) {
            $date2 = new DateTime($registros[$index]['fecha_cadu']);
            
            if($date2<$date1){
              $registros[$index]['edad']='Vencido';  
            }else{
                $interval = date_diff($date1, $date2);
                $dias=$interval->format('%a');
                if ($dias<=7){
                     $registros[$index]['edad']='Próximo a vencer'; 
                     $registros[$index]['estilo']='proximoVencer';
                }
            }
            
            
       }
    return $registros;
}

function estado($esta) {
    if ($esta == 1) {
        return "Activo";
    } else {
        return "Inactivo";
    }
}

function estado_check($esta, $val) {
    if (strcasecmp($esta, $val) == 0) {
        return "checked";
    } else {
        return "";
    }
}

function productos_organico() {
    global $var_mysqli;
    $query = "SELECT *,'' as edad,'' estilo FROM productos where tipo_producto= 'Organico' and estado_actividad=1 order by nombre_com asc";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    
    $registros = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $date1 = new DateTime("now");
    
    for ($index = 0; $index < count($registros); $index++) {
            $date2 = new DateTime($registros[$index]['fecha_cadu']);
            
            if($date2<$date1){
              $registros[$index]['edad']='Vencido';  
            }else{
                $interval = date_diff($date1, $date2);
                $dias=$interval->format('%a');
                if ($dias<=7){
                     $registros[$index]['edad']='Próximo a vencer'; 
                     $registros[$index]['estilo']='proximoVencer';
                }
            }
            
            
       }
    return $registros;
}

function optener_todos_productos_organico() {
    global $var_mysqli;
    $query = "SELECT * FROM productos where tipo_producto= 'Organico' order by estado_actividad desc,tipo_producto,nombre_com asc";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
    echo "regisatro";
}

function optener_todos_productos_quimicos() {
    global $var_mysqli;
    $query = "SELECT * FROM productos where tipo_producto= 'Quimico' order by estado_actividad desc,tipo_producto,nombre_com asc";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
    echo "regisatro";
}

function Productos($tipo, $nombrec, $principioa, $cantidadp, $fechaelab, $fechacadu, $tipo_sl, $unidad) {
    global $var_mysqli;
    $tipo_estado;
    if (strcmp("L", $tipo_sl) == 0) {
        $tipo_estado = "liquido";
    } else {
        $tipo_estado = "solido";
    }

    if ($unidad != 4) {
        if (strcmp("L", $tipo_sl) == 0) {
            switch ($unidad) {
                case 1:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.01;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.1;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 3.7854;
                    break;
                default:
                    $cantidadp = $cantidadp;
                    break;
            }
        } else {
            switch ($unidad) {
                case 0:
                    $cantidadp = $cantidadp * 0.000001;
                    break;

                case 1:
                    $cantidadp = $cantidadp * 0.00001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.0001;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 0.0283495;
                    break;
                case 6:
                    $cantidadp = $cantidadp * 0.453592;
                    break;
                case 7:
                    $cantidadp = $cantidadp * 100;
                    break;
                default:
                    break;
            }
        }
    }
    $query = "INSERT INTO productos (tipo_producto,nombre_com,principio_activo,cantidad_prod,fecha_elab,fecha_cadu,estado_sl) values (?,?,?,?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("sssdsss", $tipo, $nombrec, $principioa, $cantidadp, $fechaelab, $fechacadu, $tipo_estado)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function obtener_producto_por_id($id) {
    global $var_mysqli;
    $query = "SELECT * FROM productos where id_producto=? limit 1";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $producto = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($producto);
    if ($row == 1) {
        return $producto;
    } else {
        return NULL;
    }
    echo "obtener producto por id";
}

//****************    aPLICACION DE pRODUCTOS      *********************************************
?>


<?php require_once ("session.php"); ?>
<?php

function obtener_todas_aplicaciones() {
    global $var_mysqli;
    $query = "SELECT a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
            . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
            . " FROM aplicacion a, plantas pl , "
            . "productos pr,vinculacion v,lotes lo WHERE "
            . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function obtener_todas_aplicaciones_pendientes() {
    global $var_mysqli;
    $query = "SELECT v.fecha_siembra edad, a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
            . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
            . " FROM aplicacion a, plantas pl , "
            . "productos pr,vinculacion v,lotes lo WHERE "
            . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto "
            . "and a.fecha_prox>= CURDATE() and efectuada=0";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function obtener_todas_aplicaciones_pasadas() {
    global $var_mysqli;
    $query = "SELECT a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
            . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
            . ",a.efectuada FROM aplicacion a, plantas pl , "
            . "productos pr,vinculacion v,lotes lo WHERE "
            . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto "
            . "and (a.fecha_prox < CURDATE() or efectuada=1) ";
    //Preparacion, parametrizacion,ejecucion del query 
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Fallo la preparacion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Fallo la ejecucion: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $resultado = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $resultado;
}

function Aplicacion($nombrePlant, $nombreProd, $tratamiento, $cantidadp, $fechaAplicacion, $fechaProx, $unidad, $tipo_sl) {

    if ($unidad != 4) {
        if (strcmp("liquido", $tipo_sl) == 0) {
            switch ($unidad) {
                case 1:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.01;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.1;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 3.7854;
                    break;
                default:
                    $cantidadp = $cantidadp;
                    break;
            }
        } else {
            switch ($unidad) {
                case 0:
                    $cantidadp = $cantidadp * 0.000001;
                    break;

                case 1:
                    $cantidadp = $cantidadp * 0.00001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.0001;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 0.0283495;
                    break;
                case 6:
                    $cantidadp = $cantidadp * 0.453592;
                    break;
                case 7:
                    $cantidadp = $cantidadp * 100;
                    break;
                default:
                    break;
            }
        }
    }
    global $var_mysqli;
    $query = "INSERT INTO aplicacion (id_vinculacion,id_producto,tipotratamiento,cant_aplicada,fecha_aplicacion,fecha_prox) values (?,?,?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("iisdss", $nombrePlant, $nombreProd, $tratamiento, $cantidadp, $fechaAplicacion, $fechaProx)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    //update cantidad producto
    $query = "update productos set cantidad_prod=cantidad_prod -? where id_producto=?;";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("di", $cantidadp, $nombreProd)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function Reagendar($motivo, $id_aplicacion, $cantidadp, $fechaantigua, $fechaProx, $unidad, $tipo_sl) {

    if ($unidad != 4) {
        if (strcmp("liquido", $tipo_sl) == 0) {
            switch ($unidad) {
                case 1:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.01;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.1;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 3.7854;
                    break;
                default:
                    $cantidadp = $cantidadp;
                    break;
            }
        } else {
            switch ($unidad) {
                case 0:
                    $cantidadp = $cantidadp * 0.000001;
                    break;

                case 1:
                    $cantidadp = $cantidadp * 0.00001;
                    break;
                case 2:
                    $cantidadp = $cantidadp * 0.0001;
                    break;
                case 3:
                    $cantidadp = $cantidadp * 0.001;
                    break;
                case 5:
                    $cantidadp = $cantidadp * 0.0283495;
                    break;
                case 6:
                    $cantidadp = $cantidadp * 0.453592;
                    break;
                case 7:
                    $cantidadp = $cantidadp * 100;
                    break;
                default:
                    break;
            }
        }
    }
    global $var_mysqli;
    $query = "update aplicacion set fecha_prox=?,cant_aplicada=? where id_aplicacion=?;";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("sdi", $fechaProx, $cantidadp, $id_aplicacion)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $query = "INSERT INTO log_aplicaciones (motivo,id_aplicaciones,fecha_antigua,fecha_nueva) values (?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("siss", $motivo, $id_aplicacion, $fechaantigua, $fechaProx)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }

    //update cantidad producto
    $query = "update productos set cantidad_prod=cantidad_prod -? where id_producto=?;";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("di", $cantidadp, $nombreProd)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function obtener_aplicacion_por_id_planta($id) {
    global $var_mysqli;
    $query = "SELECT a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
            . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
            . ",a.efectuada FROM aplicacion a, plantas pl , "
            . "productos pr,vinculacion v,lotes lo WHERE "
            . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto "
            . "and  v.id_planta =? order by a.fecha_aplicacion desc";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $planta;
}

////////////////
function obtener_aplicacion_por_id_producto($id) {
    global $var_mysqli;
    $query = "SELECT v.fecha_siembra edad, a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
            . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
            . ",a.efectuada FROM aplicacion a, plantas pl , "
            . "productos pr,vinculacion v,lotes lo WHERE "
            . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto "
            . "and a.id_producto =? order by a.fecha_aplicacion desc";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $planta;
}

function obtener_aplicacion_por_id($id) {
    global $var_mysqli;
    $query = "SELECT a.id_producto,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto "
            . " ,lo.num_lote,pr.estado_sl,a.id_vinculacion ,v.id_lote FROM aplicacion a, plantas pl , productos pr ,vinculacion v,lotes lo "
            . " WHERE v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto and a.id_aplicacion=? "
            . " ";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $planta;
}
function obtener_aplicaciones_reagendadas() {
    global $var_mysqli;
    $query = "SELECT l.*,a.id_producto,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto "
            . " ,lo.num_lote,pr.estado_sl,a.id_vinculacion ,v.id_lote FROM aplicacion a, plantas pl , productos pr ,vinculacion v,lotes lo, "
            . " log_aplicaciones l WHERE v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
            . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto and a.id_aplicacion=l.id_aplicaciones "
            . " order by lo.cod_lote, pl.nomb_planta , l.fecha_antigua";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
   
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    return $planta;
}
function obtener_aplicacion_por_fecha($ini, $fin) {

    if (strcmp($ini, '1') != 0 || strcmp($fin, '1') != 0) {
        global $var_mysqli;

        $query = "SELECT a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,"
                . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
                . ",a.efectuada FROM aplicacion a, plantas pl , "
                . "productos pr,vinculacion v,lotes lo WHERE "
                . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
                . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto and efectuada=0 ";
        $tipo_var = '';

        if (strcmp($ini, '1') != 0) {
            $query .= ' and a.fecha_prox>=?';
            $tipo_var.='s';
            $arrayfecha = explode("/", $ini);
            $ini = $arrayfecha[2] . "-" . $arrayfecha[1] . "-" . $arrayfecha[0];
        }
        if (strcmp($fin, '1') != 0) {
            $query .= ' and a.fecha_prox<=?';
            $tipo_var.='s';
            $arrayfecha = explode("/", $fin);
            $fin = $arrayfecha[2] . "-" . $arrayfecha[1] . "-" . $arrayfecha[0];
        }
        $query .= ' order by a.fecha_prox desc';
        if (!$sentencia = $var_mysqli->prepare($query)) {
            echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        if (strlen($tipo_var) == 2) {
            if (!$sentencia->bind_param("ss", $ini, $fin)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        } elseif (strcmp($ini, '1') != 0) {
            if (!$sentencia->bind_param($tipo_var, $ini)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        } else {
            if (!$sentencia->bind_param($tipo_var, $fin)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        }

        if (!$sentencia->execute()) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }
        $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);

        return $planta;
    }
}

function obtener_aplicacion_por_fecha2($ini, $fin) {

    if (strcmp($ini, '1') != 0 || strcmp($fin, '1') != 0) {
        global $var_mysqli;

        $query = "SELECT a.id_producto,lo.num_lote,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
                . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto,pr.tipo_producto,pr.estado_sl"
                . ",a.efectuada FROM aplicacion a, plantas pl , "
                . "productos pr,vinculacion v,lotes lo WHERE "
                . " v.id_vinculacion=a.id_vinculacion and lo.cod_lote=v.id_lote "
                . " and v.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto and efectuada=0";
        $tipo_var = '';

        if (strcmp($ini, '1') != 0) {
            $query .= ' and a.fecha_prox>=?';
            $tipo_var.='s';
            $arrayfecha = explode("/", $ini);
            $ini = $arrayfecha[2] . "-" . $arrayfecha[1] . "-" . $arrayfecha[0];
        }
        if (strcmp($fin, '1') != 0) {
            $query .= ' and a.fecha_prox<=?';
            $tipo_var.='s';
            $arrayfecha = explode("/", $fin);
            $fin = $arrayfecha[2] . "-" . $arrayfecha[1] . "-" . $arrayfecha[0];
        }
        $query .= ' order by a.fecha_prox desc';
        if (!$sentencia = $var_mysqli->prepare($query)) {
            echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
        }

        if (strlen($tipo_var) == 2) {
            if (!$sentencia->bind_param("ss", $ini, $fin)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        } elseif (strcmp($ini, '1') != 0) {
            if (!$sentencia->bind_param($tipo_var, $ini)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        } else {
            if (!$sentencia->bind_param($tipo_var, $fin)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            }
        }

        if (!$sentencia->execute()) {
            echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
        }
        $planta = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);

        return $planta;
    }
}

//****************     Fin      *********************************************
?>
<?php

function Consulta_por_planta($id) {
    global $var_mysqli;
    $query = "SELECT * FROM vinculacion where id_vinculacion=?";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("i", $id)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $vinculacion = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($vinculacion);
    if ($row == 1) {
        return $vinculacion;
    } else {
        return NULL;
    }
}
?>
