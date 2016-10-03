<?php
require_once ("SESSION.php");
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
    $query = "INSERT INTO plantas (nomb_planta,especie,variedad,lugar_Procedencia,identificativo) values (?,?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("sssss", $nombre, $especie, $variedad, $procedencia, $identi)) {
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

function obtener_nombreplanta_por_id($id) {
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
    return $planta;
}

//****************     Lotes      *********************************************
?>


<?php

function obtener_todas_lotes() {
    global $var_mysqli;
    $query = "SELECT * FROM lotes";
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
    $query = "SELECT * FROM lotes where cod_lote=? limit 1";

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

function RegistroVinculacion() {
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

function Vinculacion($planta, $lote, $fechaSiembra, $cantidadplantas) {
    global $var_mysqli;
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

function obtener_Vinculacion_por_id($id) {
    global $var_mysqli;
    $query = "SELECT * FROM vinculacion where id_vinculacion=? limit 1";

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
    $query = "SELECT l.num_lote, pl.nomb_planta,v.fecha_siembra,pl.especie,pl.variedad, pl.identificativo,v.cant_plantas from plantas pl, vinculacion v, lotes l where l.cod_lote=v.id_lote AND pl.cod_planta = v.id_planta AND v.id_vinculacion=?";
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
    echo "regisatro";
}

function productos_quimico() {
    global $var_mysqli;
    $query = "SELECT * FROM productos where tipo_producto= 'Quimico' and estado_actividad=1 order by nombre_com asc";
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

function estado($esta) {
    if ($esta == 1) {
        return "Activo";
    } else {
        return "Inactivo";
    }
}

function estado_check($esta, $val) {
    if (strcasecmp($esta, $val)==0) {
        return "checked";
    } else {
        return "";
    }
}

function productos_organico() {
    global $var_mysqli;
    $query = "SELECT * FROM productos where tipo_producto= 'Organico' and estado_actividad=1 order by nombre_com asc";
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
function Productos($tipo, $nombrec, $principioa, $cantidadp, $fechaelab, $fechacadu,$tipo_sl,$unidad) {
    global $var_mysqli;    
    $tipo_estado;
    if (strcmp("L", $tipo_sl) == 0) {
        $tipo_estado="liquido";
    }else{
        $tipo_estado="solido";
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
                    case 5:
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
    if (!$sentencia->bind_param("sssdsss", $tipo, $nombrec, $principioa, $cantidadp, $fechaelab, $fechacadu,$tipo_estado)) {
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


<?php require_once ("SESSION.php"); ?>
<?php

function obtener_todas_aplicaciones() {
    global $var_mysqli;
    $query = "SELECT a.id_producto,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,"
            . "a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto,pr.tipo_producto FROM aplicacion a, plantas pl , "
            . "productos pr WHERE a.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto";
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

function Aplicacion($nombrePlant, $nombreProd, $tratamiento, $cantAplicada, $fechaAplicacion, $fechaProx) {
    global $var_mysqli;
    $query = "INSERT INTO aplicacion (id_planta,id_producto,tipotratamiento,cant_aplicada,fecha_aplicacion,fecha_prox) values (?,?,?,?,?,?);";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("iisiss", $nombrePlant, $nombreProd, $tratamiento, $cantAplicada, $fechaAplicacion, $fechaProx)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
}

function obtener_aplicacion_por_id_planta($id) {
    global $var_mysqli;
    $query = "SELECT a.id_producto,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto FROM aplicacion a, plantas pl , productos pr WHERE a.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto and a.id_planta=? ";

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
    $query = "SELECT pl.nomb_planta,a.cant_aplicada,a.fecha_aplicacion FROM  plantas pl, aplicacion a  WHERE pl.cod_planta=a.id_planta AND a.id_producto =? ";

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
    $query = "SELECT a.id_producto,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto FROM aplicacion a, plantas pl , productos pr WHERE a.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto and a.id_aplicacion=? ";

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

function obtener_aplicacion_por_fechaUnica($fecha) {
    global $var_mysqli;
    $query = "SELECT pr.nombre_com,pl.nomb_planta,a.tipotratamiento,a.cant_aplicada,a.fecha_prox FROM productos pr,plantas pl,aplicacion a WHERE a.fecha_aplicacion=? ";

    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("fecha", $fecha)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
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

        $query = "SELECT a.id_producto,id_planta,a.id_aplicacion ,a.tipotratamiento,a.cant_aplicada,a.fecha_aplicacion,a.fecha_prox,pl.nomb_planta,pr.nombre_com,pr.tipo_producto FROM aplicacion a, plantas pl , productos pr WHERE a.id_planta = pl.cod_planta AND a.id_producto = pr.id_producto";
        $tipo_var = '';

        if (strcmp($ini, '1') != 0) {
            $query .= ' and fecha_prox>=?';
            $tipo_var.='s';
        }
        if (strcmp($fin, '1') != 0) {
            $query .= ' and fecha_prox<=?';
            $tipo_var.='s';
        }
        echo $ini;
        echo $fin;
        if (!$sentencia = $var_mysqli->prepare($query)) {
            echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
        }
        echo $tipo_var;
        if (strlen($tipo_var) == 2) {
            if (!$sentencia->bind_param("ss", $ini, $fin)) {
                echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
            } elseif (strcmp($ini, '1') != 0) {
                if (!$sentencia->bind_param($tipo_var, $ini)) {
                    echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
                } else {
                    if (!$sentencia->bind_param($tipo_var, $fin)) {
                        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
                    }
                }
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
