<?php

require_once './session.php';
require_once './conexion.php';
function Redireccionar($ubicacion = NULL) {
    if ($ubicacion != NULL) {
        header("Location: {$ubicacion}");
        exit;
    }
}
function Login($usuario, $contrasena) {
    global $var_mysqli;
    $query = "SELECT codigo, usuario,contrasena FROM identificacion where usuario=? and  contrasena=? limit 1";
    if (!$sentencia = $var_mysqli->prepare($query)) {
        echo "Falló la PREPARACION: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->bind_param("ss", $usuario, $contrasena)) {
        echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    if (!$sentencia->execute()) {
        echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
    }
    $usuario = mysqli_fetch_all($sentencia->get_result(), MYSQLI_ASSOC);
    $row = count($usuario);
    if ($row == 1) {
        $_SESSION['codigo'] = $usuario[0]['codigo'];
        $_SESSION['usuario'] = $usuario[0]['usuario'];
        $_SESSION['contrasena'] = $usuario[0]['contrasena'];
        return "Logeado";
    } else {
        return 'Usuario o Contraseña Incorrecto';
    }
}

if (isset($_POST['submit'])) {// sI ESQ HIZO CLICK.
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $var_mensaje = Login($usuario, $contrasena);
    if (strcmp($var_mensaje, 'Logeado') == 0) {
         Redireccionar("/Ecuaforestar/usuarios/menu.php");
    } else {
         Redireccionar("/Ecuaforestar/usuarios/login.php?error="+  rand());
    }
} else {
    Redireccionar("/Ecuaforestar/usuarios/login.php");
}
?>
